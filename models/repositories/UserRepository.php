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
        $sql = <<<SQL
            select users.id, login, password, hash, access from users
                inner join access on users.access_id = access.id
                where $key = ?;
        SQL;
        $param = [$value];

        return Db::getInstance()->queryObject($sql, $param, $this->getEntitiesName());
    }

    public function isAuth(Session $session)
    {
        if (isset($_COOKIE['hash'])) {
            $hash = $_COOKIE['hash'];
            $user_data = $this->getUser('hash', $hash);
            $user = $user_data->login;
            if (!empty($user)) {
                $session->userLogin = $user;
            }
        }
        $login = $session->userLogin;
        return isset($login) ? true : false;
    }

    public function checkLogPwd($login, $pass, $user, Session $session)
    {
        if (password_verify($pass, $user->password)) {
            $session->userLogin = $login;
            $session->userId = $user->id;
            $session->userAccess = $user->access;

            return true;
        }
        return false;
    }

    public function getTableName()
    {
        return 'users';
    }

    public function getEntitiesName()
    {
        return UserModel::class;
    }
}