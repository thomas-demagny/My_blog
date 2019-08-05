<?php


namespace Model;


/**
 * Class articleModel
 * @package Model
 */
class articleManager extends Database
{

    /**
     * @return array
     */
    public function getArticles()
    {
        $database = $this->databaseConnexion();
        $result = $database->prepare('SELECT * FROM articles ORDER BY dte');
        $result->execute();
        return $result->fetchAll();
    }


    /**
     * @param $dataId
     * @return mixed
     */
    public function getArticle($dataId)
    {
        $database = $this->databaseConnexion();
        $result = $database->prepare('SELECT * FROM articles WHERE id = ?');
        $result->execute(array($dataId));
        return $result->fetchObject();
    }

}