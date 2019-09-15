<?php


namespace Model;


use Model;

/**
 * Class UserManager
 * @package Model
 */
class UserManager extends Model\Model
{
    /**
     * @param $username
     * @return bool
     */
    public function controlUser($username, $email)
    {
        $pdo = $this->getPDO();
        $result = $pdo->prepare('SELECT * FROM user WHERE username = ?  OR email = ? LIMIT 1');
        $result->execute(array($username, $email));
        if ($result->fetch()) {
            return true;
        }
        return false;
    }

    /**
     * @param $username
     * @return mixed
     */
    public function verifyUser($username)
    {
        $pdo = $this->getPDO();
        $result = $pdo->prepare('SELECT * FROM user WHERE username= ?');
        $result->execute(array($username));
        if ($result->fetch()) {
            return true;
        }
        return false;
    }

    /**
     * @param $username
     * @return mixed
     */
    public function find($username)
    {
        $pdo = $this->getPDO();
        $result = $pdo->prepare('SELECT * FROM user WHERE username = ?');
        $result->execute (array($username));
        return $result->fetch();
    }
    /**
     * @return array
     */
    public function findAll()
    {
        $pdo = $this->getPDO();
        $result = $pdo->prepare('SELECT * FROM user ORDER BY register_date AND role');
        $result->execute();
        return $result->fetchAll();
    }

    /**
     * @param $info
     * @return bool
     */
    public function insertUser($info)
    {

        $pdo = $this->getPDO();
        $result = $pdo->prepare("INSERT INTO user (firstname, surname, username, email, password, role, register_date) VALUES (?,?,?,?,?,'membre', CURRENT_DATE)");
        $result = $result->execute(array(
            $info['firstname'], $info['surname'], $info['username'], $info['email'], $info['password']));
        return $result;
    }





}