<?php

namespace App\Entities;

use Spot\Entity;
use Spot\Mapper;
//use League\OAuth2\Server\Entities\UserEntityInterface;

class UserEntity extends Entity /*implements UserEntityInterface*/
{
    protected static $table = 'users';

    public static function fields()
    {
        return [
            'id'           => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'name'         => ['type' => 'string', 'required' => true],
            'password'     => ['type' => 'string', 'required' => true],
            'email'        => ['type' => 'string', 'required' => true],
            'body'         => ['type' => 'text', 'required' => true],
            'status'       => ['type' => 'integer', 'default' => 0, 'index' => true],
            'date_created' => ['type' => 'datetime', 'value' => new \DateTime()],
            'date_updated' => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

    /**
     * Return the user's identifier.
     *
     * @return mixed
     */
    public function getIdentifier()
    {
        return 1;
    }
}
