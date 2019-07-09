<?php


namespace Model;

use Model\PDOConnexion;


class ArticleModel extends PDOConnexion
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
     * @param $id
     * @return mixed
     */
    public function getArticle($id)
    {
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM articles WHERE id');
        $req->execute(array($id));
        return $req->fetchObject();
    }

}