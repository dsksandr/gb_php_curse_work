<?php


namespace app\models\repositories;


use app\core\Db;
use app\models\entities\OrderModel;
use app\models\Repository;

class OrderRepository extends Repository
{
    public function getOrderStatus()
    {
        $sql = "
            SELECT * FROM order_status 
        ";
        return Db::getInstance()->queryAll($sql, []);
    }

    public function getTableName()
    {
        return "orders";
    }

    public function getEntitiesName()
    {
        return OrderModel::class;
    }
}