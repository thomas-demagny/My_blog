<?php


namespace Model;


/**
 * Class ArticleManager
 * @package Model
 */
class ArticleManager extends Model
{
//protected $table = 'articles';


    /**
     * @return array
     */
    public function findAll()
    {
        $result = $this->pdo->prepare('SELECT * FROM articles ORDER BY dte');
        $result->execute();
        return $result->fetchAll();

    }

    /**
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
     * @param array $info
     */
    public function insert(array $info)
    {
        $result = $this->pdo->prepare('INSERT INTO articles (title, author, chapo, content, dte ) VALUES (?,?,?,?, NOW())');
        $result->execute(array($info['title'], $info['author'], $info['chapo'], $info['content']));
    }

    /**
     * @param array $info
     * @return bool
     */
    public function update(array $info)
    {
        $result = $this->pdo->prepare('UPDATE articles SET title = ?, author = ?, chapo = ? , content = ? , dte = NOW() WHERE id =  ? ');
        $result->execute(array($info['title'], $info['author'], $info['headline'], $info['content'], $info['id']));
        return $result;
    }

    /**
     * @param int $dataID
     */
    public function delete(int $dataID)
    {
        $req = $this->pdo->prepare('DELETE FROM articles WHERE id = ?');
        $req->execute(array($dataID));
    }


}