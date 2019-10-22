<?php


namespace Controller;


use Model\ArticleManager;
use Model\CommentManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


/**
 * Class ArticleController
 * @package Controller
 */
class ArticleController extends Controller
{


    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction()
    {
        $articlesManager = new ArticleManager();
        $articles = $articlesManager->findAll();


        return $this->render('blog.html.twig', compact('articles'));
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
        $articlesManager = new ArticleManager();
        $articles = $articlesManager->find($dataId);;

        $commentManager = new CommentManager();
        $comments = $commentManager->findAll($dataId);


        return $this->render('article.html.twig', compact('articles', 'comments'));

    }

    /**
     * @param array $info
     */
    public function createAction()
    {
        $info['title'] = filter_input(INPUT_POST, 'title');
        $info['chapo'] = filter_input(INPUT_POST, 'chapo');
        $info['content'] = filter_input(INPUT_POST, 'create');
        $info['author'] = $this->session->getUser('username');



        $articleManager = new ArticleManager();
        $articleManager->insert($info);
        $this->redirect('../public/index.php?access=admin');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function updateAction()
    {
        $dataId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $articlesManager = new ArticleManager();
        $articles = $articlesManager->find($dataId);
        //va chercher l'article avec le manager get
        //render vers ma vue modifiée en chargeant l'article
        return $this->render('article.html.twig', compact('articles'));
    }

    /**
     *on supprime les commentaires puis l'article
     */
    public function deleteAction()
    {
        $dataId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $commentManager = new CommentManager();
        $commentManager->deleteFromArticle($dataId);
        $articleManager = new ArticleManager();
        $articleManager->delete($dataId);
        $this->redirect('../public/index.php?access=admin');
        $this->alert('Etes vous certain de vouloir supprimer cet article ?');

    }


}