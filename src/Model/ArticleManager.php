<?php


namespace Model;


/**
 * Class ArticleManager
 * @package Model
 */
class ArticleManager extends Model
{


    /**
     * va chercher tous les articles
     * @return array
     */
    public function findAll()
    {
        $result = $this->pdo->prepare('SELECT * FROM articles ORDER BY dte DESC ');
        $result->execute();
        return $result->fetchAll();

    }

    /**
     * cherche l'article demandé
     * @param int $dataId
     * @return mixed
     */
    public function find(int $dataId)
    {
        $result = $this->pdo->prepare('SELECT * FROM articles WHERE id = ?');
        $result->execute(array($dataId));
        return $result->fetchObject();

    }

    /**
     * création et insertion de l'article
     * @param array $info
     */
    public function insert(array $info)
    {
        $result = $this->pdo->prepare('INSERT INTO articles (title, author, chapo, content, dte, mod_dte ) VALUES (?,?,?,?, NOW(), NOW())');
        $result->execute(array($info['title'], $info['author'], $info['chapo'], $info['content']));
    }

    /**
     * mise à jour d'un article déjà écrit
     * @param array $info
     * @return bool
     */
    public function update(array $info)
    {
        $result = $this->pdo->prepare('UPDATE articles SET title = ?, author = ?, chapo = ? , content = ? , dte = NOW(), mod_dte= NOW() WHERE id = ? ');
        $result->execute(array($info['title'], $info['author'], $info['chapo'], $info['content'], $info['articleId']));
        return true;


    }

    /**
     * supprime un article
     * @param int $dataID
     */
    public function delete(int $dataID)
    {
        $req = $this->pdo->prepare('DELETE FROM articles WHERE id = ?');
        $req->execute(array($dataID));
    }


}