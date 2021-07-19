<?php


namespace app\models\repositories;


use app\models\entities\Users;
use app\models\Repository;

class UsersRepository extends Repository
{

    public function isAuth() {
        return isset($_SESSION['login']) ? true: false;
    }

    public function getName() {
        return @$_SESSION['login'];
    }

    public function checkAdmin() {
        if (@$_SESSION['is_admin'])
        {
            $admin = true;
        } else {
            $admin = false;
        }
        return $admin;
    }

    public function auth($login, $pass) {
        $user = $this->getWhereOne('login', $login);
        if (password_verify($pass, $user->pass)) {
            $_SESSION['login'] = $login;
            if($user->is_admin) {
                $_SESSION['is_admin'] = true;
            }
            return true;
        }
    }

    public function getTableName()
    {
        return "users";
    }


    public function getEntityClass()
    {
        return Users::class;
    }
}
