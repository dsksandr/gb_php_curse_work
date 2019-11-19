<?php


namespace app\models\repositories;

use app\core\Db;
use app\core\Session;
use app\models\entities\UserModel;
use app\models\Repository;

class UserRepository extends Repository
{

    public function getUser($key, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE `{$key}` = ?";
        return Db::getInstance()->queryObject($sql, [$value], $this->getEntitiesName());
    }

    public function updateUserData($id, $hash)
    {
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET hash = `{$hash}` WHERE users . id = `{$id}`";
        Db::getInstance()->execute($sql, []);
        return true;
    }


    public function isAuth(Session $session)
    {
        if (isset($_COOKIE['hash'])) {
            $hash = $_COOKIE['hash'];
            $user_data = $this->getUser('hash', $hash);
            $user = $user_data['login'];
            if (!empty($user)) {
                $session->setUserLogin($user);
            }
        }
        return isset($session->login) ? true : false;
    }

    public function checkLogPwd($login, $pass, Session $session)
    {
        $user_data =  $this->getUser('login', $login);

        if (password_verify($pass, $user_data->password)) {
            $session->setUserLogin($login);
            $session->setUserId($user_data->id);

//            var_dump($user_data);
//            var_dump($pass);
            return true;
        }
        return false;
    }

    public function getTableName()
    {
        return "users";
    }

    public function getEntitiesName()
    {
        return UserModel::class;
    }
}