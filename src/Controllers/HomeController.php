<?php

namespace App\Controllers;

class HomeController
{
    public function index($response)
    {
        return $response->withJson(array('message' => 'Durianphp in the making'), 400);
    }
}
