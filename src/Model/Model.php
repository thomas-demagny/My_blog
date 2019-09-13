<?php

namespace Model;

use PDO;

/**
 * Class Model
 */
abstract class Model

{

    /**
     * @var null
     */
    static protected $pdo = null;


    /**
     * @return PDO|null
     */
    public function getPDO()
    {
        require_once '../config/dbconfig.php'; //TODO modifier les ../ si non valide.

        if ((self::$pdo) === null) {
            self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        }

        return self::$pdo;

    }

}