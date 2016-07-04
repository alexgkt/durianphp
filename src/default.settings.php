<?php

return [
    // Slim 3 settings
    'settings.httpVersion' => '1.1',
    'settings.responseChunkSize' => 4096,
    'settings.outputBuffering' => 'append',
    'settings.determineRouteBeforeAppMiddleware' => false,
    'settings.displayErrorDetails' => true,
    'settings.addContentLengthHeader' => true,
    'settings.routerCacheFile' => false,

    // DB Settings
    'db.name' => 'database',
    'db.user' => 'user',
    'db.pass' => 'password',
    'db.host' => 'localhost',
    'db.port' => '3306',

    // Logger Settings
    'logger.name' => 'app',
    'logger.path' => __DIR__ . '/../log/app.log',
];
