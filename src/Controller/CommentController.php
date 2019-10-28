<?php


namespace Controller;


use Model\ArticleManager;
use Model\CommentManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class CommentController
 * @package Controller
 */
class CommentController extends Controller
{
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

            $commentManager = new CommentManager;
            $commentManager->insert($author, $content, $articles_id, $uid);
            //on recupère l'article avec les commentaires
            $comments = $commentManager->findAll($articles_id);

            $ArticleManager = new ArticleManager;
            $articles = $ArticleManager->find($articles_id);
            return $this->render('article.html.twig', compact('author', 'content', 'articles_id', 'uid', 'articles', 'comments'));

        }
            $this->alert('Vous ne pouvez pas envoyer un commentaire vide !');
            $this->redirect('../public/index.php?access=article');


    }

    /**
     *récupère les commentaires non validé
     */
    public function notYetValidatedAction()
    {

        $commentManager = new CommentManager();
        $commentManager->notYetValidated();


    }

    public function validateAction()
    {
        $dataId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $commentManager = new CommentManager();
        $commentManager->publish($dataId);
        $this->redirect('../public/index.php?access=admin');
    }

    /**
     * @return string
     */
    public function deleteAction()
    {
        $comment_id = filter_input(INPUT_GET, 'id');
        $commentManager = new CommentManager();
        $commentManager->delete($comment_id);

        $this->redirect('../public/index.php?access=admin');

    }
}