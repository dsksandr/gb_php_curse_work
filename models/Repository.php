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

        foreach ($entity->props as $key => $value) {
            $params[":{$key}"] = "{$entity->$key}";
            $columns[] = $key;
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));

        $tableName = $this->getTableName();

        $sql = "insert into $tableName ( $columns ) values ( $values )";

        $result = Db::getInstance()->execute($sql, $params);

        $entity->id = Db::getInstance()->lastInsertId();

        return $result;
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
            $params[":{$key}"] = $entity->{$key};
            $columns[] .= "`" . $key . "` = :" . $key;
            $entity->props[$key] = false;
        }

        $columns = implode(", ", $columns);
        $tableName = $this->getTableName();
        $params[':id'] = $entity->id;

        $sql = "update $tableName set $columns where `id` = :id";

        Db::getInstance()->execute($sql, $params);
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
