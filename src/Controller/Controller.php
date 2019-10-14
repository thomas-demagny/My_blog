<?php


namespace Controller;

use Model\ArticleManager;
use Model\CommentManager;
use Model\UserManager;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


/**
 * Class Controller
 * @package Controller
 */
abstract class Controller
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var SessionController
     */
    protected $session;

    /**
     * Controller constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->session =  new SessionController();

    }


    /**
     * @param string $view
     * @param array $var
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(string $view, array $var = [])
    {
        extract($var);
        return $this->twig->render($view, $var);
    }


    /**
     * @param $message
     */
    public function alert($message)
    {
        $alert = "<script>alert('$message');</script>";
        echo filter_var($alert);
    }

}