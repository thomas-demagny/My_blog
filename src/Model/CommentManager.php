<?php


namespace Model;



use Model;
/**
 * Class CommentManager
 * @package Model
 */
class CommentManager extends Model\Model
{

    /**
     * @param int $dataId
     * @return array
     */
    public function findAll(int $dataId)
    {
        $pdo = $this->getPDO();
        $req = $pdo->prepare('SELECT * FROM comments WHERE articles_id = ?');
        $req->execute(array($dataId));
        return $req->fetchAll();
    }

    /**
     * @param string $author
     * @param string $content
     * @param int $articles_id
     * @param int $uid
     */
    public function insert(string $author, string $content, int $articles_id, int $uid)
    {
        $pdo = $this->getPDO();
        $req = $pdo->prepare("INSERT INTO comments (author, content, dte, statement, articles_id, user_id) VALUES (?,?,NOW(),'0',?,?)");
        $req->execute(array($author, $content, $articles_id, $uid));
    }
}