<?php


namespace Model;

use PDO;


/**
 * Class Model
 * @package Model
 */
abstract class Database
{
    /**
     * @var null
     */
    static protected $database = null;


    /**
     * @return PDO|null
     */
    public function databaseConnexion()
{
    require_once '../config/dbconfig.php'; //TODO modifier les ../ si non valide.

    if ((self::$database)=== null)
    {
        $database = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8' , DB_USER, DB_PASS);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        self::$database = $database;
    }

    return self::$database;
}

}