<?php


namespace Controller;


use Model\UserManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;


/**
 * Class UserController
 * @package Controller
 */
class UserController extends Controller
{

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function indexAction()
    {

        return $this->render('connexion.twig');
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function signupAction()
    {
        $info['username'] = filter_input(INPUT_POST, 'signup_username', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['password'] = filter_input(INPUT_POST, 'signup_password', FILTER_SANITIZE_STRING);
        $info['confirmpassword'] = filter_input(INPUT_POST, 'confirmpassword', FILTER_SANITIZE_STRING);
        $info['firstname'] = filter_input(INPUT_POST, 'signup_firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['surname'] = strtoupper(filter_input(INPUT_POST, 'signup_surname', FILTER_SANITIZE_SPECIAL_CHARS));
        $info['email'] = filter_input(INPUT_POST, 'signup_email', FILTER_SANITIZE_SPECIAL_CHARS);


        $userModel = new UserManager();


        if (empty($info['username']) || empty($info['email']) || $userModel->controlUser($info)) {
            echo "<script>alert('Un pseudo et/ou une adresse mail existe déjà, merci de vous connecter')</script>";

            return $this->render('connexion.twig', array('info' => $info));


        }

        if (!empty($info['firstname']) AND !empty($info['surname']) AND !empty($info['password']) AND !empty($info['confirmpassword'])) {
            if ($info['password'] == $info['confirmpassword']) {
                $info['password'] = password_hash($info['password'], PASSWORD_BCRYPT);
                $userModel->addUser($info);
                echo "<script>alert('Merci vous êtes bien inscrit')</script>";
                return $this->render('home.twig');
            }
            echo "<script>alert('Vos deux mots de passe doivent être identique')</script>";
            return $this->render('connexion.twig', array('info' => $info));

        }
        return $this->render('connexion.twig');

    }

    /**
     *
     * @return string
     */
    public function signinAction()
    {

        if (!empty($info['username']) && !empty($info['password'])) {
            $userModel = new UserManager();
            $user = $userModel->controlUser($info['username']);
            if ($user !== false) {
                $user = $userModel->getUser($info['username'], $info['password']);
                if (password_verify($info['password'], $info['confirmpassword']) == true) ;
            }
        }


        return;
    }
}

















