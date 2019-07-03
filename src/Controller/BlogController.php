<?php


namespace Controller;


class BlogController extends Controller
{
    /**
     * @return \Twig\Environment
     */
    public function indexAction(){
        return $this->render('blog.twig');
    }
}