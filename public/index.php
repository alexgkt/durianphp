<?php
// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}
require __DIR__ . '/../vendor/autoload.php';

session_start();
// Instantiate the app

$app = new \App\App;
// Register services
//require __DIR__ . '/../src/services.php';
// Register middleware
//require __DIR__ . '/../src/middleware.php';
// Register routes
require __DIR__ . '/../src/routes.php';
// Run!
$app->run();
