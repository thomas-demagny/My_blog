<?php


namespace Model;


/**
 * Class UserModel
 * @package Model
 */
class UserModel extends PDOConnexion
{
    public function controlUser($nickname, $email)
    {
        $database = $this->databaseConnexion();
        $req = $database->prepare('SELECT * FROM user WHERE nickname = ? OR email = ?  LIMIT 1');
        $req->execute(array($nickname, $email));

        return true;
    }

//return quoi? requete?
}