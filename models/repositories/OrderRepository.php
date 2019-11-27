<?php


namespace app\models\repositories;


use app\core\App;
use app\models\entities\OrderModel;
use app\models\Repository;

class OrderRepository extends Repository
{
    public
    function getOrderStatus()
    {
        $sql = <<<SQL
            select * from order_status 
        SQL;

        return App::call()->db->queryAll($sql, []);
    }

    public
    function getTableName()
    {
        return "orders";
    }

    public
    function getEntitiesName()
    {
        return OrderModel::class;
    }
}