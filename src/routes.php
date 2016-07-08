<?php

$app->get('/', ['\App\Controllers\HomeController', 'index']);
$app->get('/user', ['\App\Controllers\UserController', 'index']);
