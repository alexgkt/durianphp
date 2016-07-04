<?php

namespace App\Controllers;

class HomeController extends \App\Controllers\BaseController
{
    public function index($response)
    {
        print_r($this->db);
        return $response->withJson(array('message' => 'Durianphp in the making'), 200);
    }
}
