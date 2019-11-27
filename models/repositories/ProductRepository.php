<?php


namespace app\models\repositories;


use app\models\entities\ProductModel;
use app\models\Repository;

class ProductRepository extends Repository
{
    public
    function getTableName()
    {
        return "products";
    }

    public
    function getEntitiesName()
    {
        return ProductModel::class;
    }
}