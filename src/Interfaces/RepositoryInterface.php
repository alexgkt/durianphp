<?php

namespace App\Interfaces;

interface RepositoryInterface{
  public function insert($data);
  public function update($data, $conditions);
  public function find($id);
  public function findAll($orderBy = []);
  public function query($args = [], $orderBy = []);
  public function getCount();
  public function prepareData($data, $toArray = false);
}
