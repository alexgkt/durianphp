<?php

namespace App;

use DI\ContainerBuilder;
use Interop\Container\ContainerInterface;

class App extends \DI\Bridge\Slim\App
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        //$builder->useAutowiring(false);
        $builder->addDefinitions(__DIR__ . '/settings.php');

        // Services
        $services = [
            \Doctrine\DBAL\Connection::class => function(ContainerInterface $container) {
                $config = new \Doctrine\DBAL\Configuration();

                $connectionParams = array(
                    'dbname' => $container->get('db.name'),
                    'user' => $container->get('db.user'),
                    'password' => $container->get('db.pass'),
                    'host' => $container->get('db.host'),
                    'port' => $container->get('db.port'),
                    'charset' => 'utf8',
                    'driver' => 'pdo_mysql',
                );
                $dbh = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

                return $dbh;
            },
            \Psr\Log\LoggerInterface::class => function(ContainerInterface $container) {
                $name = $container->get('logger.name');
                $filepath = $container->get('logger.path');

                $logger = new \Monolog\Logger($name);
                $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
                $logger->pushHandler(new \Monolog\Handler\StreamHandler($filepath, \Monolog\Logger::DEBUG));

                return $logger;
            }
        ];

        $builder->addDefinitions($services);
    }
}
