<?php

namespace Model;


use PDO;

/**
 * Class Model
 * @package Model
 */
abstract class Model

{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var
     */
//    protected $table;


    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = Database::getPDO();
    }

    /**
     * @param string $key
     * @return array
     */
 /*   public function findAll(int $dataId)
    {

        $result = $this->pdo->prepare('SELECT * FROM ' . $this->table);
        $result->execute($dataId);
        return $result->fetchAll();
    }*/


    /**
     * @param int $key
     * @return mixed
     */
/*    public function find(int $key)
    {
        $result = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE  id = ? ');

        $result->execute($key);
        return $result->fetchObject();
    }*/


    /**
     * @param array $info
     */
   /* public function insert(array $info)
    {
        $key = implode(",", array_keys($info));
        $values = implode('","', $info);
        $result = $this->pdo->prepare('INSERT INTO ' . $this->table . ' (' . $key . ') VALUES ("' . $values . '")');
        $result->execute(array($info));
    }*/


}