<?php


namespace Controller;

session_start();


class HomeController extends Controller
{
public function indexAction()
{
    return $this->render('home.twig');

}
}