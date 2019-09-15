<?php


namespace Controller;


use Model\ArticleManager;
use Model\CommentManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class BlogController
 * @package Controller
 */
class BlogController extends Controller

{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction()
    {
        $articles = (new ArticleManager)->findAll();
        return $this->render('blog.twig', compact('articles'));
    }


    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function commentAction()
    {
        $articles_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $content = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);

        if (!empty($articles_id) && !empty($content)) {

            $uid = $this->session->getUser('id');
            $author = $this->session->getUser('username');
            $commentManager = new CommentManager();
            $commentManager->insert($author, $content, $articles_id, $uid);
            //on recupère l'article et le commentaire
            $comments = $commentManager->findAll($articles_id);
            $ArticleManager = new ArticleManager();
            $articles = $ArticleManager->find($articles_id);
            return $this->render('article.twig', compact('author', 'content', 'articles_id', 'uid', 'articles', 'comments'));
        }
        return $this->render('article.twig', compact('author', 'content', 'articles_id', 'uid'));


        }




    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function readAction()
    {
        $dataId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $articles = (new ArticleManager)->find($dataId);
        $comments = (new CommentManager)->findAll($dataId);

        return $this->render('article.twig', compact('articles', 'comments'));
    }

}






