<?php


namespace Model;


/**
 * Class commentModel
 * @package Model
 */
class CommentManager extends Database
{
    /**
     * @param $dataId
     * @return array
     */
    public function getComments($dataId)
    {
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM comments WHERE articles_id = ?');
        $req->execute(array($dataId));
        return $req->fetchAll();
    }
}