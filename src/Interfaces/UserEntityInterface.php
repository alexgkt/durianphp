<?php

namespace App\Interfaces;

interface UserEntityInterface
{
    public function getId();
    public function setId($id);

    public function getName();
    public function setName($name);

    public function getPassword();
    public function setPassword($password);

    public function getEmail();
    public function setEmail($email);

    public function getStatus();
    public function setStatus($status);

    public function getCreated();
    public function setCreated($date);

    public function getUpdated();
    public function setUpdated($date);

    public function toArray();
}
