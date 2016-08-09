<?php

namespace App\Entities;

use App\Interfaces\UserEntityInterface;

class UserEntity implements UserEntityInterface
{
    private $id;
    private $name;
    private $password;
    private $email;
    private $status;
    private $created;
    private $updated;

    public function __construct($user = [])
    {
        $currDate = date("Y-m-d H:i:s");

        if(isset($user['id'])){
            $this->setId($user['id']);
        }

        if(isset($user['name'])){
            $this->setName($user['name']);
        }

        if(isset($user['password'])){
            $this->setPassword($user['password']);
        }

        if(isset($user['email'])){
            $this->setEmail($user['email']);
        }

        $status = isset($user['status']) ? $user['status'] : 1;

        $this->setStatus($status);

        if(isset($user['date_created'])) {
            $this->setCreated($user['date_created']);
        }
        else
        {
            $this->setCreated($currDate);
        }

        if(isset($user['date_updated'])) {
            $this->setUpdated($user['date_updated']);
        }
        else{
            $this->setUpdated($currDate);
        }
        //$this->setDateUpdated($currDate);

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($date)
    {
        $this->created = $date;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($date)
    {
        $this->updated = $date;
    }

    public function toArray()
    {
      return get_object_vars($this);
    }
}
