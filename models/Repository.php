<?php

namespace app\models;


use app\core\Db;
use app\interfaces\IModels;

abstract class Repository implements IModels
{
    public function getLimit($from, $to)
    {

    }

    public function getWhere($name, $value)
    {

    }

    public function insert(Model $entity)
    {
        $params = [];
        $columns = [];

        foreach ($entity as $key => $value) {
            if ($key == "id") continue;
            $params[":{$key}"] = $value;
            $columns[] = "`$key`";
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));

        $tableName = $this->getTableName();

        $sql = "INSERT INTO '{$tableName}' ('{$columns}') VALUES ('{$values}')";

        Db::getInstance()->execute($sql, $params);

        $entity->id = Db::getInstance()->lastInsertId();
    }

    public function delete(Model $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM `{$tableName}` WHERE `id` = ?";
        return Db::getInstance()->execute($sql, [$entity->id]);
    }

    public function update(Model $entity)
    {
        $params = [];
        $columns = [];

        foreach ($entity->props as $key => $value) {
            if (!$entity->props[$key]) continue;
            $params[":{$key}"] = $this->$key;
            $columns[] .= "`" . $key . "` = :" . $key;
            $this->$entity[$key] = false;
        }

        $columns = implode(", ", $columns);
        $tableName = $this->getTableName();

        $sql = "UPDATE `{$tableName}` SET `{$columns}` WHERE `id` = ?";
        Db::getInstance()->execute($sql, [$entity->id]);
    }

    public function save(Model $entity)
    {
        if (is_null($entity->id))
            $this->insert($entity);
        else
            $this->update($entity);
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE `id` = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], $this->getEntitiesName());
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return Db::getInstance()->queryAll($sql);
    }
}
