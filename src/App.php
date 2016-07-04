<?php

namespace App;

use DI\ContainerBuilder;
use Interop\Container\ContainerInterface;

class App extends \DI\Bridge\Slim\App
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions(__DIR__ . '/settings.php');

        // Services
        $services = [
            '\Spot\Locator::class' => function(ContainerInterface $container) {
                $cfg = new \Spot\Config();

                $cfg->addConnection('mysql', [
                    'dbname' => \DI\get('db.name'),
                    'user' => \DI\get('db.user'),
                    'password' => \DI\get('db.pass'),
                    'host' => \DI\get('db.host'),
                    'port' => \DI\get('db.port'),
                    'driver' => 'pdo_mysql',
                ]);

                $spot = new \Spot\Locator($cfg);

                return $spot;
            },
            '\Psr\Log\LoggerInterface::class' => function(ContainerInterface $container) {
                $name = \DI\get('logger.name');
                $filepath = \DI\get('logger.path');

                $logger = new \Monolog\Logger($name);
                $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
                $logger->pushHandler(new \Monolog\Handler\StreamHandler($filepath, \Monolog\Logger::DEBUG));

                return $logger;
            }
        ];

        $builder->addDefinitions($services);
    }
}
