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
        return $this->render('home.twig');

    }


        /**
         * @return string
         * @throws \Twig\Error\LoaderError
         * @throws \Twig\Error\RuntimeError
         * @throws \Twig\Error\SyntaxError
         */
        public function portfolioAction()
        {
            return $this->render('portfolio.twig');
        }

}