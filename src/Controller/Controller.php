<?php


namespace Controller;

use Twig\Environment;


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

    protected $session;
    /**
     * Controller constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->session =  new Session();

    }


    /**
     * @param string $view
     * @param array $var
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
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