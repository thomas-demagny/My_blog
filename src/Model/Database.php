<?php


namespace Model;


use PDO;


/**
 * Class Database
 * @package Model
 */
class Database
{

    /**
     * @return PDO
     */
    public static function getPdo()
    {
        require_once '../config/dbconfig.php'; //TODO modifier les ../ si non valide en ligne.
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;

    }
}