<?php


namespace Model;




/**
 * Class CommentManager
 * @package Model
 */
class CommentManager extends Model
{
//protected $table = 'comments';


    /**
     * @param int $articlesID
     * @return array
     */
    public function findAll(int $articlesID)
    {

        $result = $this->pdo->prepare("SELECT * FROM comments WHERE articles_id = ? ORDER BY id desc ");
        $result->execute(array($articlesID));
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

}