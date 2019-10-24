<?php


namespace Controller;



use Model\CommentManager;
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

        return $this->render('connexion.html.twig');
    }


    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function registerAction()
    {
        $info['username'] = filter_input(INPUT_POST, 'signupUsername', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['password'] = filter_input(INPUT_POST, 'signupPassword', FILTER_SANITIZE_STRING);
        $info['confirmPassword'] = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
        $info['firstname'] = filter_input(INPUT_POST, 'signupFirstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $info['surname'] = strtoupper(filter_input(INPUT_POST, 'signupSurname', FILTER_SANITIZE_SPECIAL_CHARS));
        $info['email'] = filter_input(INPUT_POST, 'signupEmail', FILTER_SANITIZE_SPECIAL_CHARS);

        $userManager = new UserManager();
        if ($userManager->controlUser($info['username'], $info['email'])) {
            $this->alert("Un pseudo et/ou une adresse mail existe déjà, merci de vous connecter");

            return $this->render('connexion.html.twig', array($info));

        }

        if (!empty($info['firstname']) AND !empty($info['surname']) AND !empty($info['password']) AND !empty($info['confirmPassword'])) {
            if ($info['password'] == $info['confirmPassword']) {
                $info['password'] = password_hash($info['password'], PASSWORD_BCRYPT);

                $userManager->insertUser($info);
                $this->alert("Merci vous êtes bien inscrit");
                return $this->render('home.html.twig');
            }
            $this->alert("Vos deux mots de passe doivent être identiques");
            return $this->render('connexion.html.twig', compact('info'));

        }
        return $this->render('connexion.html.twig');

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

//Vérifie que l’utilisateur existe avec le username
            $user = $userManager->verifyUser($username);
            //Ensuite on récupère ses données
            if ($user !== false) {

                $user = $userManager->find($username);
                //Et on vérifie le password

                if (password_verify($password, $user['password']) === true) {
                    $this->session->create($user['id'], $user['username'], $user['email'], $user['role']);
                    $this->alert("Bienvenue $username !");

                    return $this->render('home.html.twig', array('session' => filter_var_array($_SESSION)));

                }
            }
        }
        $this->alert('Pseudo ou mot de passe incorrect !');
        return $this->render('connexion.html.twig');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function logoutAction()
    {
        if ($this->session->isLogged()) {
            $this->session->destroy();
        }
        return $this->render('home.html.twig', array('session' => $this->session = filter_var_array($_SESSION)));
    }


    /**
     *
     */
    public function deleteAction()
    {
        $userId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $commentManager = new CommentManager();
        $commentManager->deleteToUser($userId);
        $userManager = new UserManager();
        $userManager->delete($userId);
        $this->redirect('../public/index.php?access=admin');
    }
}


























