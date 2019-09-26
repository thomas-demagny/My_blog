<?php


namespace Controller;


/**
 * Class Session
 * @package Controller
 */
class Session
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
     * @param $userid
     * @param $username
     * @param $email
     */
    public function create($id, $username, $email, $role)
    {
        $_SESSION['user'] = [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'role' => $role
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
     * @return |null
     */
    public function getUser($var)
    {
        if ($this->isLogged() === false){
            return null;
        }
        return $this->user[$var];
    }



}