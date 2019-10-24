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
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction()
    {

        if ($this->session->getUser('role') === 'admin') {
            $articlesManager = new ArticleManager();
            $articles = $articlesManager->findAll();
            $commentsManager = new CommentManager();
            $comments = $commentsManager->notYetValidated();
            $userManager = new UserManager();
            $user = $userManager->findAll();
            return $this->render('admin/admin_home.html.twig', compact('articles', 'comments', 'user'));
        }exit("What the hell !! You want to hack me ?? Get away from here !"); //au cas où quelqu'un tente d'accéder directement à l'admin en passant par l'url

    }

}