<?php


namespace Model;


/**
 * Class articleModel
 * @package Model
 */
class articleModel extends PDOConnexion
{

    /**
     * @return array
     */
    public function getArticles()
    {
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM articles ORDER BY dte');
        $req->execute();
        return $req->fetchAll();
    }


    /**
     * @param $dataId
     * @return mixed
     */
    public function getArticle($dataId)
    {
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM articles WHERE id = ?');
        $req->execute(array($dataId));
        return $req->fetchObject();
    }

}