<?php


namespace Controller;


use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HomeController
 * @package Controller
 */
class HomeController extends Controller
{

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction()
    {
        return $this->render('home.html.twig');

    }


    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function portfolioAction()
    {
        return $this->render('portfolio.html.twig');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function errorAction()
    {
        return $this->render('error404.html.twig');

    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function mailAction()
    {
        $name = filter_input(INPUT_POST, 'name');
        $surname = filter_input(INPUT_POST, 'surname');
        $mail = filter_input(INPUT_POST, 'email');
        $content = filter_input(INPUT_POST, 'content');

        $from = "tom10440@saumon.o2switch.net";
        $email = "demagny.t@gmail.com";
        $object = 'message de ' . $name . $surname . ' <' . $mail . '>';
        $message = $content;
        $header = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $header .= 'From: ' . $from . "\r\n";
        mail($email, $object, $message, $header);
        $this->alert('Votre mail à bien été envoyé.');
        return $this->render('home.html.twig');
    }


}