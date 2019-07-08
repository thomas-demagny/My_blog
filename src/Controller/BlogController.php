<?php


namespace Controller;

use Model\ArticlesModel;
use Model\Model;


class BlogController extends Controller
{
    /**
     * @return \Twig\Environment
     */
    public function indexAction(){

$articles = (new ArticlesModel)->getArticles;
        return $this->render('blog.twig',array('articles' =>$articles));
    }
}

