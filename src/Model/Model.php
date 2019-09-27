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
     * @param string $author
     * @param $content
     * @param $dte
     * @param $articles_id
     * @param $uid
     */
    public function insert(string $author, string $content, string $dte,  int $articles_id, int $uid)
    {
        $key = implode(",", array_keys($data));
        $values = implode('","', $data);
        $req = $this->pdo->prepare('INSERT INTO ' . $this->table . "(' . $key . ') VALUES ("' . $values . '")');
        $req->execute(array($author, $content, $dte, $articles_id, $uid));
    }
}