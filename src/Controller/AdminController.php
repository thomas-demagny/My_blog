<?php


namespace Controller;

use Model\ArticleManager;
use Model\CommentManager;
use Model\UserManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


/**
 * Class AdminController
 * @package Controller
 */
class AdminController extends Controller
{


    /**
     * @param string $articles
     * @param $comments
     * @param $user
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function adminAction()
    {
        $dataId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($this->session->getUser('role') === 'admin') {


            $articles = new ArticleManager();
            $articles->findAll();
            //$comments = new CommentManager();
            //$comments->findAll();

            //faire boucle for articles pour afficher tous les commentaires de chaques articles.
            $user = new UserManager();
            $user->findAll();
            return $this->render('admin/admin_home.html.twig', compact('articles', 'comments', 'user'));
        }
        return $this->render('connexion.html.twig');





    }

    public function createAction()
    {
        //création d'un nouvel article
    }

    public function readAction()
    {
        //édition des articles et des commentaires
    }

    public function updateAction()
    {
        //modifications des articles
    }

    public function deleteAction()
    {
        //suppression
    }

    public function moderateAction()
    {
        //moderation des commentaires
    }
}