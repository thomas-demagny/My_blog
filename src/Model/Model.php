<?php

namespace Model;


/**
 * Class Model
 * @package Model
 */
abstract class Model

{


    /**
     * @var \PDO
     */
    protected $pdo;
    protected $table;


    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = Database::getPDO();
    }

    /**
     * @return array
     */
    public function findAll()
    {

        $result = $this->pdo->prepare('SELECT * FROM ' . $this->table);
        $result->execute();
        return $result->fetchAll();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function find(string $key)
    {

        $result = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $key . ' = ?');
        $result->execute(array($key));
        return $result->fetchObject();
    }

    /**
     * @param array $data
     */
    public function insert(array $data)
    {


        $key = implode(",", array_keys($data));
        $values = implode('","', $data);
        $req = $this->pdo->prepare('INSERT INTO ' . $this->table . ' (' . $key . ') VALUES ("' . $values . '")');
        $req->execute(array($data));
    }
}