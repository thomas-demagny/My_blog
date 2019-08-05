<?php


namespace Model;


/**
 * Class UserModel
 * @package Model
 */
class UserManager extends Database
{
    /**
     * @param $username
     * @param $password
     * @return bool|mixed|\PDOStatement
     */
    public function getUser($username, $password)
    {
        $database = $this->databaseConnexion();
        $result = $database->prepare('SELECT * FROM user WHERE username= ? AND password= ?');
        $result->execute(array($username, $password));
        $req = $result->fetchObject();
        return ($result);
    }
    /**
     * @param $data
     * @return bool
     */
    public function controlUser($data)
    {
        $database = $this->databaseConnexion();
        $result = $database->prepare('SELECT * FROM user WHERE username = ? OR email = ?  LIMIT 1');
        $result->execute(array($data['username'], $data['email']));
        if ($result->fetch()) {
            return true;
        }
        return false;
    }


    /**
     * @param $info
     * @return bool
     */
    public function addUser($info)
    {

        $database = $this->databaseConnexion();
        $result = $database->prepare("INSERT INTO user (firstname, surname, username, email, password, role, register_date) VALUES (?,?,?,?,?,'membre', CURRENT_DATE)");
        $result = $result->execute(array(
            $info['firstname'], $info['surname'], $info['username'], $info['email'], $info['password']));
        return $result;
    }


    /**
     * @param $data
     * @return bool
     */
    public function verifyUser($data)
    {
        $database = $this->databaseConnexion();
        $result = $database->prepare('SELECT * FROM user WHERE username= ?');
        $result->execute(array($data['username']));
        if ($result->fetch()) {
            return true;
        }
        return false;
    }


}