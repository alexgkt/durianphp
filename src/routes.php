<?php

$app->get('/', ['\App\Controllers\HomeController', 'index']);

$app->group('/user', function () {
    $this->map(['GET', 'POST'], '', ['\App\Controllers\UserController', 'index']);
    $this->map(['GET', 'PUT', 'DELETE'], '/{id:[0-9]+}', ['\App\Controllers\UserController', 'index2']);
    $this->post('login', ['\App\Controllers\UserController', 'login']);
});
