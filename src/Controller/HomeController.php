<?php


namespace Controller;


/**
 * Class HomeController
 * @package Controller
 */
    class HomeController extends Controller
    {

        /**
         * @return string
         * @throws \Twig\Error\LoaderError
         * @throws \Twig\Error\RuntimeError
         * @throws \Twig\Error\SyntaxError
         */
        public function indexAction()
    {
        return $this->render('home.html.twig');

    }


        /**
         * @return string
         * @throws \Twig\Error\LoaderError
         * @throws \Twig\Error\RuntimeError
         * @throws \Twig\Error\SyntaxError
         */
        public function portfolioAction()
        {
            return $this->render('portfolio.html.twig');
        }

        /**
         *
         */
        public function mailAction()
        {
            $message = "Line1/r/n/Line2/r/n/Line3";
            $message = wordwrap($message, 150, "\r\n");
            $to      = 'personne@example.com';
            $from   =
            $subject = 'le sujet';
            $message = 'Bonjour !';
            $headers = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
        }


}