<?php


namespace Controller;


/**
 * Class SessionController
 * @package Controller
 */
class SessionController
{
    /**
     * @var mixed
     */
    private $session;

    /**
     * @var
     */
    private $user;

    /**
     * SessionController constructor.
     */
    public function __construct()
    {
        $this->session = filter_var_array($_SESSION);

        if (isset($this->session['user'])) {
            $this->user = $this->session['user'];
        }
    }


    /**
     * @param string $username
     * @param string $email
     */
    public function create(string $username, string $email)
    {
        $_SESSION['user'] = [
            'username' => $username,
            'email' => $email
        ];
    }

    /**
     *
     */
    public function destroy()
    {
        $_SESSION['user'] = [];
        session_destroy();
    }

    /**
     * @return bool
     */
    public function isLogged()
    {
        if (array_key_exists('user', $this->session)){
            if (!empty($this->user)){
                return true;
            }
        }return false;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return |null
     */
    public function getUser()
    {
        if ($this->isLogged() === false){
            return null;
        }
        return $this->user;
    }


}