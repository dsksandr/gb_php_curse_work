<?php

namespace app\models;


use app\core\Db;

class UserModel extends DBModel
{
    protected $id;
    protected $login;
    protected $password;
    protected $hash;

    protected $props = [
        'id' => false,
        'login' => false,
        'password' => false,
        'hash' => false,
    ];

    public function __construct(
        $id = null,
        $login = null,
        $password = null,
        $hash = null)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->hash = $hash;
    }

    public static function getUser($key, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE `{$key}` = ?";
        return Db::getInstance()->queryObject($sql, [$value], static::class);
    }

    public static function updateUserData($id, $hash)
    {
        $tableName = static::getTableName();
        $sql = "UPDATE `{$tableName}` SET hash = `{$hash}` WHERE users . id = `{$id}`";
        Db::getInstance()->execute($sql, []);
        return true;
    }

    public static function getTableName()
    {
        return "users";
    }
}