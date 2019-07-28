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
        $info['firstname'] = filter_input(INPUT_POST, 'signupfirstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['surname'] = strtoupper(filter_input(INPUT_POST, 'signupsurname', FILTER_SANITIZE_SPECIAL_CHARS));
        $info['username'] = filter_input(INPUT_POST, 'signupusername', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['email'] = filter_input(INPUT_POST, 'signupemail', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['password'] = filter_input(INPUT_POST, 'signuppassword', FILTER_SANITIZE_STRING);
        $info['confirmpassword'] = filter_input(INPUT_POST, 'confirmpassword', FILTER_SANITIZE_STRING);
        $userModel = new UserModel();


        if (empty($info['username']) || empty($info['email']) || $userModel->controlUser($info)) {
            echo "<script>alert('Une pseudo et/ou une adresse mail existe déjà, merci de vous connecter')</script>";

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
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function signinAction()
    {

        $username['username'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $userModel = new UserModel();

        $user = $userModel->verifyUser($username);
        if ($user !== false) {
            $user = $userModel->getUser($username);
            if (password_verify($password, $username['password'])) {

                echo "<script>alert('Vous êtes connecté !')</script>";
                return $this->render('home.twig');
            }
            echo "<script>alert('L\'identifiant et/ou le mot de passe sont incorrect  !')</script>";
        }
        return $this->render('connexion.twig');

    }
}

















