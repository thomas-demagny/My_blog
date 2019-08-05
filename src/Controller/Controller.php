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
    /**

    /**
     * Controller constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;

    }


    /**
     * @param string $view
     * @param array $params
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $view, array $params = [])
    {
        return $this->twig->render($view, $params);
    }




}