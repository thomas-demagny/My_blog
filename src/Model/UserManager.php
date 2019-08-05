<?php


namespace Model;


/**
 * Class UserModel
 * @package Model
 */
class UserModel extends PDOConnexion
{

    /**
     * @param $data
     * @return bool
     */
    public function controlUser($data)
    {
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM user WHERE username = ? OR email = ?  LIMIT 1');
        $req->execute(array($data['username'],$data['email']));
        if ($req->fetch()) {
            return true;
        }
        return false;
    }


    /**
     * @param $info
     * @return bool
     */
    public function addUser($info){

        $database = $this->databaseConnexion();
        $req = $database->prepare("INSERT INTO user (firstname, surname, username, email, password, role, register_date) VALUES (?,?,?,?,?,'membre', CURRENT_DATE)");
        $req->execute(array($info['firstname'], $info['surname'], $info['username'], $info['email'], $info['password']));
        return true;
    }


    /**
     * @param $data
     * @return bool
     */
    public function verifyUser($data)
    {
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM user WHERE username= ?');
        $req->execute(array($data['username']));
        if ($req->fetch()) {
            return true;
        }
        return false;
    }

    /**
     * @param $username
     * @return bool|mixed|\PDOStatement
     */
    public function getUser($username){
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM user WHERE username= ?');
        $req->execute(array($username));
        $req = $req->fetch();
        return $req;
    }
}