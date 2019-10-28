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
        if ($dataId != '') {
            $articlesManager = new ArticleManager();
            $articles = $articlesManager->find($dataId);;
            $commentManager = new CommentManager();
            $comments = $commentManager->findAll($dataId);
            if ($articles != null){
                return $this->render('article.html.twig', compact('articles', 'comments'));
            }$this->redirect('../public/index.php?access=home');
        }$this->redirect('../public/index.php?access=home');

    }


    /**
     * pour la création d'article
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
    public function updateLoadAction()
    {
        $dataId = filter_input(INPUT_GET, 'id');
        $articleManager = new ArticleManager();
        $article = $articleManager->find($dataId);
        return $this->render("admin/articleModify.html.twig", compact('article'));
    }


    /**
     * @return string
     */
    public function updateAction()
    {
        $info['title'] = filter_input(INPUT_POST, 'title');
        $info['chapo'] = filter_input(INPUT_POST, 'chapo');
        $info['content'] = filter_input(INPUT_POST, 'content');
        $info['author'] = $this->session->getUser('username');
        $info['articleId'] = filter_input(INPUT_GET, 'id');

        $articlesManager = new ArticleManager();
        $articlesManager->update($info);
        $this->redirect('../public/index.php?access=admin');

    }


    /**
     *on supprime les commentaires de l'article puis l'article
     */
    public function deleteAction()
    {
        $dataId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $commentManager = new CommentManager();
        $commentManager->deleteFromArticle($dataId);
        $articleManager = new ArticleManager();
        $articleManager->delete($dataId);
        $this->redirect('../public/index.php?access=admin');


    }


}