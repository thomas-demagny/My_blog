<?php


namespace Controller;

use Model\articleModel;
use Model\commentModel;


/**
 * Class BlogController
 * @package Controller
 */
class BlogController extends Controller
{


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function indexAction(){

$articles = (new articleModel)->getArticles();
        return $this->render('blog.twig',array('articles' =>$articles));
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function readAction(){

        $dataId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $articles = (new articleModel)->getArticle($dataId);
        $comments = (new commentModel)->getComments($dataId);

        return $this->render('article.twig', array('articles' => $articles, 'comments' => $comments));
    }

}

