<?php

namespace app\models;


use app\core\App;
use app\interfaces\IModels;

abstract
class Repository implements IModels
{
    public
    function getLimit($from, $to)
    {
//        todo:
    }

    public
    function getWhere($name, $value)
    {
//        todo:
    }

    public
    function insert(Model $entity)
    {
        $params = [];
        $columns = [];

        foreach ($entity->props as $key => $value) {
            $params[":{$key}"] = $entity->$key;
            $columns[] = $key;
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));

        $tableName = $this->getTableName();

        $sql = <<<SQL
            insert into $tableName ( $columns ) values ( $values )
        SQL;

        $result = App::call()->db->execute($sql, $params);

        $entity->id = App::call()->db->lastInsertId();

        return $result;
    }

    public
    function delete(Model $entity)
    {
        $tableName = $this->getTableName();
        $sql = <<<SQL
            delete from $tableName where id = ?;
        SQL;
        $params = [$entity->id];

        return App::call()->db->execute($sql, $params);
    }

    public
    function update(Model $entity)
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
        $params[':id'] = (int) $entity->id;

        $sql = <<<SQL
            update $tableName set $columns where id = :id;
        SQL;

        return App::call()->db->execute($sql, $params);
    }

    public
    function save(Model $entity)
    {
        if (is_null($entity->id))
            $this->insert($entity);
        else
            $this->update($entity);
    }

    public
    function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = <<<SQL
            select * from $tableName where id = ?
        SQL;
        $params = [$id];

        return App::call()->db->queryObject(
                $sql,
                $params,
                $this->getEntitiesName()
            );
    }

    public
    function getAll()
    {
        $tableName = $this->getTableName();
        $sql = <<<SQL
            select * from $tableName
        SQL;

        return App::call()->db->queryAll($sql);
    }
}
