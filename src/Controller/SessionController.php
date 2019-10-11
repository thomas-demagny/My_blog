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
    protected $session;

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
     * @param $role
     */
    public function create($userid, $username, $email, $role)
    {
        $_SESSION['user'] = [
            'id' => $userid,
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
     * @param $var
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