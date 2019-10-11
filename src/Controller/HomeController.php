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
        public function mailAction()
        {
            $name = htmlentities(filter_input(INPUT_POST,'name'));
            $mail = htmlentities(filter_input(INPUT_POST,'mail'));
            $content = htmlentities(filter_input(INPUT_POST,'message'));
            $from = "admin@oc.thomas-demagny.com";
            $email = "demagny.t@gmail.com";
            $subject = 'message de ' .$name.' <'.$mail.'>';
            $message = $content;
            $header = 'MIME-Version: 1.0'."\r\n";
            $header .= 'Content-type: text/html; charset=utf-8'."\r\n";
            $header .= 'From: '.$from."\r\n";
            mail($email,$subject,$message, $header);
            $this->alert('Votre mail est bien envoyé.');
            return $this->render('home.html.twig');
        }


}