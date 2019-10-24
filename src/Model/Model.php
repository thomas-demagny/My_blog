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
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = Database::getPDO();
    }

}