<?php


namespace app\models;

use app\core\Db;
use app\interfaces\IModels;


abstract class Model implements IModels
{
    protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function getItem($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE `id` = `{$id}`";
        return $this->db->queryOne($sql);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return $this->db->queryOne($sql);
    }

    abstract public function getTableName();
}
