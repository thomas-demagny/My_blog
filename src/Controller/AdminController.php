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
    public function indexAction()
    {

        if ($this->session->getUser('role') === 'admin') {


            $articles = (new ArticleManager())->findAll;
            $comments = (new CommentManager())->findAll;
            $user = (new UserManager())->findAll;
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