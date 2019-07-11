<?php


namespace Controller;

use Model\articleModel;
use Model\commentModel;


class BlogController extends Controller
{
    /**
     * @return \Twig\Environment
     */
    public function indexAction(){

$articles = (new articleModel)->getArticles();
        return $this->render('blog.twig',array('articles' =>$articles));
    }

    public function readAction(){

        $dataId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $articles = (new articleModel)->getArticle($dataId);
        $comments = (new commentModel)->getComments($dataId);

        return $this->render('article.twig', array('articles' => $articles, 'comments' => $comments));
    }

}

