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
     * Controller constructor
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return Environment
     */
    public function render(string $view, array $params = [])
    {
        return $this->twig->render($view, $params);
    }


    public function addFlash()
    {
       // @TODO faire message d'alert !!!!
    }

}