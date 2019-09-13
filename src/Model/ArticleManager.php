<?php


namespace Model;


use Model;


/**
 * Class ArticleManager
 * @package Model
 */
class ArticleManager extends Model\Model
{

    /**
     * @return array
     */
    public function findAll()
    {
        $pdo = $this->getPDO();
        $result = $pdo->prepare('SELECT * FROM articles ORDER BY dte');
        $result->execute();
        return $result->fetchAll();
    }


    /**
     * @param $dataId
     * @return mixed
     */
    public function find(int $dataId)
    {
        $pdo = $this->getPDO();
        $result = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
        $result->execute(array($dataId));
        return $result->fetchObject();
    }

}