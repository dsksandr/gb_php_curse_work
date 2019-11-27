<?php


namespace app\models\repositories;

use app\core\App;
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

        return App::call()->db->queryObject(
                $sql,
                $param,
                $this->getEntitiesName()
            );
    }

    public function isAuth()
    {
        if (isset($_COOKIE['hash'])) {
            $hash = $_COOKIE['hash'];
            $user_data = $this->getUser('hash', $hash);
            $user = $user_data->login;
            if (!empty($user)) {
                App::call()->session->setUserLogin($user);
            }
        }
        $login = App::call()->session->getUserLogin();

        return isset($login) ? true : false;
    }

    public function checkLogPwd($pass, $user)
    {
        return password_verify($pass, $user->password);
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