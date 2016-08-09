<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Entities\UserEntity as User;

class UserRepository extends BaseRepository implements RepositoryInterface
{
    protected $_table = 'users';
    protected $_pk = 'id';

    public function prepareData($data, $toArray = false){
      $object = new User($data);
      return $toArray ? $object->toArray() : $object;
    }
}
