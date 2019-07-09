<?php


namespace Controller;

use Model\articleModel;



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

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $articles = (new articleModel)->getArticle($id);

        return $this->render('article.twig', array('articles' => $articles));
    }

}

