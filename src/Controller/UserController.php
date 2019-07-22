<?php


namespace Controller;


use Model\UserModel;

/**
 * Class UserController
 * @package Controller
 */
class UserController extends Controller
{
    /**
     * @return \Twig\Environment
     */
    public function indexAction()
    {

        return $this->render('connexion.twig');
    }

    /**
     * @return \Twig\Environment
     */
    public function signupAction()
    {

        $info['firstname'] = filter_input(INPUT_POST, 'signupfirstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['surname'] = filter_input(INPUT_POST, 'signupsurname', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['username'] = filter_input(INPUT_POST, 'signupusername', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['email'] = filter_input(INPUT_POST, 'signupemail', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['password'] = filter_input(INPUT_POST, 'signuppassword', FILTER_SANITIZE_STRING);
        $info['confirmpassword'] = filter_input(INPUT_POST, 'confirmpassword', FILTER_SANITIZE_STRING);
        $usermodel = new UserModel();

        $data = $usermodel->controlUser($info ['username'], $info['email']);

        if ($data == true) {
            echo "<script>alert('erreur ! Un pseudo ou une adresse mail est déjà enregistrée, veuillez vous connecter .');</script>";
            return $this->render('connexion.twig');
        }
    }
}


