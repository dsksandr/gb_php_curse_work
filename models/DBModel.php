<?php

namespace app\models;


use app\core\DB;

abstract class DBModel extends Model
{

    public function getLimit($from, $to)
    {

    }

    public function getWhere($name, $value)
    {

    }

    public function insert()
    {
        $params = [];
        $columns = [];

        //var_dump($this->props);

        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            $params[":{$key}"] = $value;
            $columns[] = "`$key`";
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));

        $tableName = static::getTableName();

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";

        DB::getInstance()->execute($sql, $params);

        $this->id = DB::getInstance()->lastInsertId();

        return $this;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return DB::getInstance()->execute($sql, ["id" => $this->id]);
    }

    public function update()
    {
        //TODO сделать умный update по props
    }

    public function save()
    {
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id";
        return DB::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return DB::getInstance()->queryAll($sql);
    }

    abstract public static function getTableName();

}