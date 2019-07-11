<?php


namespace Model;


/**
 * Class commentModel
 * @package Model
 */
class commentModel extends PDOConnexion
{
    /**
     * @param $id
     * @return array
     */
    public function getComments($id)
    {
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM comments WHERE articles_id = ?');
        $req->execute(array($id));
        return $req->fetchAll();
    }
}