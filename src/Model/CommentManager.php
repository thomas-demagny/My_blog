<?php


namespace Model;


use PDOStatement;

/**
 * Class CommentManager
 * @package Model
 */
class CommentManager extends Model
{


    /**
     * @param int $articlesId
     * @return array
     */
    public function findAll(int $articlesId)
    {

        $result = $this->pdo->prepare("SELECT * FROM comments WHERE articles_id = ? ORDER BY id desc ");
        $result->execute(array($articlesId));
        return $result->fetchAll();
    }

    /**
     * @param string $author
     * @param string $content
     * @param int $articles_id
     * @param int $uid
     */
    public function insert(string $author, string $content, int $articles_id, int $uid)
    {

        $result = $this->pdo->prepare("INSERT INTO comments (author, content, dte, statement, articles_id, user_id) VALUES (?,?,NOW(),'0',?,?)");
        $result->execute(array($author, $content, $articles_id, $uid));
    }


    /**
     * @return array|bool|PDOStatement
     */
    public function notYetValidated()
    {
        $result = $this->pdo->prepare('SELECT id, author, dte, content, user_id FROM comments WHERE statement = 0 AND articles_id ORDER BY articles_id DESC ');
        $result->execute();
        $result = $result->fetchAll();
        return $result;
    }

    /**
     * @param $commentId
     */
    public function publish($commentId)
    {
        $result = $this->pdo->prepare("UPDATE comments SET statement = 1 WHERE id = ? ");
        $result->execute(array($commentId));
    }

    /**
     * @param $commentId
     */
    public function delete($commentId)
    {
        $result = $this->pdo->prepare('DELETE FROM comments WHERE id= ?');
        $result->execute(array($commentId));
    }

    /**
     * @param $dataId
     */
    public function deleteFromArticle($dataId)
    {
        $result = $this->pdo->prepare('DELETE FROM comments WHERE articles_id= ?');
        $result->execute(array($dataId));

    }

    /**
     * @param $userId
     */
    public function deleteToUser($userId)
    {
        $result = $this->pdo->prepare('DELETE FROM comments WHERE user_id= ?');
        $result->execute(array($userId));
    }

}