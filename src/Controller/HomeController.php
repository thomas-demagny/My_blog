<?php


namespace Controller;




class HomeController extends Controller
{
    /**
     * @return \Twig\Environment
     */
public function indexAction()
{
    return $this->render('home.twig');

}
}