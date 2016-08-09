<?php

namespace App\Repositories;

use Doctrine\DBAL\Connection;

abstract class BaseRepository
{
    protected $_conn;
    protected $_builder;
    protected $_table;
    protected $_pk;

    public function __construct(Connection $conn){
        $this->_conn = $conn;
        $this->_builder = $conn->createQueryBuilder();
    }

    public function getCount()
    {
        return $this->_conn->fetchColumn("SELECT count($this->_pk) FROM {$this->_table}");
    }

    public function find($id)
    {
        $query = $this->_builder
          ->select('*')
          ->from($this->_table)
          ->where($this->_pk . ' = :id')
          ->setParameter(':id' , $id);

        $result = $query->execute()->fetch();
print_r($this->prepareData($result));exit;
        return $result ? $this->prepareData($result) : false;
    }

    public function findAll($orderBy = [])
    {
        $query = $this->_builder
          ->select('*')
          ->from($this->_table);

        if(!empty($orderBy)){
          foreach($orderBy as $col => $val){
            $query->orderBy($col, $val);
          }
        }

        $results = $query->execute()->fetchAll();

        $datas = [];

        foreach($results as $item){
          $datas[$item->id] = $this->prepareData($item);
        }

        return $datas;
    }

    public function query($cols = [], $args = [], $orderBy = []){

        if(!empty($cols)){
          $cols = "'". implode("' , '", $cols) . "'";
        }
        else
        {
          $cols = '*';
        }

        $query = $this->_builder
          ->select($cols)
          ->from($this->_table);

        if(!empty($args)){
          foreach($args as $col => $val){
            $query
              ->where("$col = :$col")
              ->setParameter(":$col" , $val);
          }
        }

        if(!empty($orderBy)){
          foreach($orderBy as $col => $val){
            $query->orderBy($col, $val);
          }
        }

        $results = $query->execute()->fetchAll();

        $datas = [];

        foreach($results as $item){
          $datas[$item->id] = $this->prepareData($item);
        }

        return $datas;
    }

    public function insert($data)
    {
      $values = $this->prepareData($data, true);
      $this->_conn->insert($this->_table, $values);
    }

    public function update($data, $conditions)
    {
      $values = $this->prepareData($data, true);
      $this->_conn->update($this->_table, $values, $conditions);
    }

    abstract public function prepareData($data, $toArray = false);
}
