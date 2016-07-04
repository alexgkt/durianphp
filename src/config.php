<?php

return [
  'settings.displayErrorDetails' => true,
  \Spot\Config::class => function (ContainerInterface $container) {

    $cfg = new \Spot\Config();// MySQL
    $cfg->addConnection('mysql', [
        'dbname' => getenv('db_name'),
        'user' => getenv('db_user'),
        'password' => getenv('db_pass'),
        'host' => getenv('db_host'),
        'port' => getenv('db_port'),
        'driver' => 'pdo_mysql',
        'charset' => getenv('db_charset'),
    ]);

    $spot = new \Spot\Locator($cfg);

    return $spot;
  }
]
