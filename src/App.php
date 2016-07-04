<?php

namespace App;

use DI\ContainerBuilder;
use Interop\Container\ContainerInterface;

class App extends \DI\Bridge\Slim\App
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        // Slim 3 settings
        $settings = [
            'settings.httpVersion' => '1.1',
            'settings.responseChunkSize' => 4096,
            'settings.outputBuffering' => 'append',
            'settings.determineRouteBeforeAppMiddleware' => false,
            'settings.displayErrorDetails' => getenv('debug_mode'),
            'settings.addContentLengthHeader' => true,
            'settings.routerCacheFile' => false,
        ];

        $builder->addDefinitions($settings);

        // Services
        $services = [
            '\Spot\Locator::class' => function(ContainerInterface $c) {
                $cfg = new \Spot\Config();

                $cfg->addConnection('mysql', [
                    'dbname' => getenv('db_name'),
                    'user' => getenv('db_user'),
                    'password' => getenv('db_pass'),
                    'host' => getenv('db_host'),
                    'port' => getenv('db_port'),
                    'driver' => 'pdo_mysql',
                ]);

                $spot = new \Spot\Locator($cfg);

                return $spot;
            },
            '\Monolog\Logger::class' => function(ContainerInterface $c){
                $name = getenv('logger_name');
                $filepath = __DIR__ . '/../log/' . getenv('logger_filename');

                $logger = new Monolog\Logger($name);
                $logger->pushProcessor(new Monolog\Processor\UidProcessor());
                $logger->pushHandler(new Monolog\Handler\StreamHandler($filepath, Monolog\Logger::DEBUG));

                return $logger;
            }
        ];

        $builder->addDefinitions($services);
    }
}
