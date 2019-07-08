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
     * @var null
     */
    static protected $db = null;


    /**
     * @return PDO|null
     */
    public function DBconnect()
{
    require_once '../config/database.php'; //TODO modifier les ../ si non valide.

    if ((self::$db)=== null)
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8' , DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        self::$db = $db;
    }

    return self::$db;
}

}