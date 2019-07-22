<?php


namespace Model;


/**
 * Class UserModel
 * @package Model
 */
class UserModel extends PDOConnexion
{
    /**
     * @param $username
     * @param $email
     * @return bool
     */
    public function controlUser($username, $email)
    {
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM user WHERE username = ? OR email = ?  LIMIT 1');
        $req->execute(array($username, $email));
        if ($req->fetch()) {
            return true;
        }
        return false;
    }


    /**
     * @param $info
     */
    public function addUser($info){

        $database = $this->databaseConnexion();
        $req = $database->prepare("INSERT INTO user (firstname, surname, username, email, password) VALUES (?,?,?,?,?)");
        $req->execute(array($info['firstname'], $info['surname'], $info['username'], $info['email'], $info['password']));
    }


}