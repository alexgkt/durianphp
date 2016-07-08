<?php

namespace App\Controllers;

use Spot\Locator as DB;

class UserController
{
    private $user;

    public function __construct(DB $db){
      $this->user = $db->mapper('App\Entities\UserEntity');
      $this->user->migrate();
    }

    public function index($response)
    {
        return $response->withJson(array('message' => 'User'), 200);
    }
}
