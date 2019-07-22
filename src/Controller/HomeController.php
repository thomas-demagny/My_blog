<?php


namespace Controller;


/**
 * Class HomeController
 * @package Controller
 */
    class HomeController extends Controller
    {
        /**
         * @return \Twig\Environment
         */
    public function indexAction()
    {
        return $this->render('home.twig');

    }

        public function portfolioAction()
        {
            return $this->render('portfolio.twig');
        }

}