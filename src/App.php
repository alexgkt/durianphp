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
            \Spot\Locator::class => function(ContainerInterface $container) {
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
            \League\OAuth2\Server\AuthorizationServer::class => function (ContainerInterface $container) {
                // Setup the authorization server
                $server = new AuthorizationServer(
                    new \App\Repositories\ClientRepository(),         // instance of ClientRepositoryInterface
                    new \App\Repositories\AccessTokenRepository(),    // instance of AccessTokenRepositoryInterface
                    new \App\Repositories\ScopeRepository(),          // instance of ScopeRepositoryInterface
                    'file://'.__DIR__.'/../data/private.key',         // path to private key
                    'file://'.__DIR__.'/../data/public.key'           // path to public key
                );
                $grant = new PasswordGrant(
                    new \App\Repositories\UserRepository(),           // instance of UserRepositoryInterface
                    new \App\Repositories\RefreshTokenRepository()    // instance of RefreshTokenRepositoryInterface
                );
                $grant->setRefreshTokenTTL(new \DateInterval('P1M')); // refresh tokens will expire after 1 month
                // Enable the password grant on the server with a token TTL of 1 hour
                $server->enableGrantType(
                    $grant,
                    new \DateInterval('PT1H') // access tokens will expire after 1 hour
                );
                return $server;
            },
            \Psr\Log\LoggerInterface::class => function(ContainerInterface $container) {
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
