<?php


namespace app\models\repositories;

use app\core\Db;
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

    public function getTableName()
    {
        return "users";
    }

    public function getEntitiesName()
    {
        return UserModel::class;
    }
}