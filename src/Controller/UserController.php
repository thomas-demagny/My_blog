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
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction()
    {

        return $this->render('connexion.twig');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function registerAction()
    {
        $info['username'] = filter_input(INPUT_POST, 'signup_username', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['password'] = filter_input(INPUT_POST, 'signup_password', FILTER_SANITIZE_STRING);
        $info['confirmpassword'] = filter_input(INPUT_POST, 'confirmpassword', FILTER_SANITIZE_STRING);
        $info['firstname'] = filter_input(INPUT_POST, 'signup_firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['surname'] = strtoupper(filter_input(INPUT_POST, 'signup_surname', FILTER_SANITIZE_SPECIAL_CHARS));
        $info['email'] = filter_input(INPUT_POST, 'signup_email', FILTER_SANITIZE_SPECIAL_CHARS);


        $userManager = new UserManager();


        if ($userManager->controlUser($info['username'], $info['email'])) {
            $this->alert("Un pseudo et/ou une adresse mail existe déjà, merci de vous connecter");

            return $this->render('connexion.twig', compact('info'));


        }

        if (!empty($info['firstname']) AND !empty($info['surname']) AND !empty($info['password']) AND !empty($info['confirmpassword'])) {
            if ($info['password'] == $info['confirmpassword']) {
                $info['password'] = password_hash($info['password'], PASSWORD_BCRYPT);
                $userManager->insertUser($info);
                $this->alert("Merci vous êtes bien inscrit");
                return $this->render('home.twig');
            }
            $this->alert("Vos deux mots de passe doivent être identique");
            return $this->render('connexion.twig', compact('info'));

        }
        return $this->render('connexion.twig');

    }


    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function logAction()
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//on vérifie que username et password ne soient pas vide
        if (!empty($username) and !empty($password)) {
            $userManager = new UserManager();
            $this->alert("ca bloque !");

//Vérifie que l’utilisateur existe avec le username
            $user = $userManager->verifyUser($username);
                //Ensuite on récupère ses données
                if ($user !== false) {
                    $user = $userManager->find($username);
                    //Et on vérifie le password
                    $this->alert("ca bloque pas !");
                    if (password_verify($password, $user['password']) === true) {
                        $this->session->create($user['id'], $user['username'], $user['email']);

                        $this->alert("Bienvenue chez Tom's Blog !");
                        return $this->render('home.twig', array('session' => filter_var_array($_SESSION)));

                    }
                }
            }


            $this->alert('Pseudo ou mot de passe incorrect !');
            return $this->render('portfolio.twig');
        }


}























