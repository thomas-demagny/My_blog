<?php


namespace Model;


/**
 * Class UserManager
 * @package Model
 */
class UserManager extends Model
{


    /**
     * @param $username
     * @return mixed
     */
    public function find($username)
    {

        $result = $this->pdo->prepare('SELECT * FROM user WHERE username = ?');
        $result->execute(array($username));
        return $result->fetch();
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $result = $this->pdo->prepare("SELECT * FROM user ORDER BY username");
        $result->execute();
        return $result->fetchAll();
    }

    /**
     * @param $info
     * @return bool
     */
    public function insertUser($info)
    {
        $result = $this->pdo->prepare("INSERT INTO user (firstname, surname, username, email, password, role, register_date) VALUES (?,?,?,?,?,'membre', CURRENT_DATE)");
        $result = $result->execute(array(
            $info['firstname'], $info['surname'], $info['username'], $info['email'], $info['password']));
        return $result;
    }

    /**
     * @param $username
     * @param $email
     * @return bool
     */
    public function controlUser($username, $email)
    {
        $result = $this->pdo->prepare('SELECT * FROM user WHERE username = ?  OR email = ? LIMIT 1');
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
        $result = $this->pdo->prepare('SELECT * FROM user WHERE username= ?');
        $result->execute(array($username));
        if ($result->fetch()) {
            return true;
        }
        return false;
    }

    /**
     * @param int $userId
     */
    public function delete($userId)
    {
        $req = $this->pdo->prepare('DELETE FROM user WHERE id= ? ');
        $req->execute(array($userId));
    }


}


