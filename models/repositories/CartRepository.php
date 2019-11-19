<?php


namespace app\models\repositories;


use app\core\Db;
use app\models\entities\CartModel;
use app\models\Repository;

class CartRepository extends Repository
{
    public function changeProductCount($id, $quantity)
    {
        $session_id = session_id();
        $tableName = $this->getTableName();
        $sql = "
            INSERT INTO `{$tableName}` (`product_id`, `session_id`) VALUES (?, ?)
                ON DUPLICATE KEY UPDATE `count` = `count` + ?;
        ";

        return Db::getInstance()->execute($sql, [$id, $session_id, $quantity]);
    }

    public function getCartCount()
    {
        $session_id = session_id();
        $tableName = $this->getTableName();
        $sql = "
            SELECT SUM(`count`) as count FROM `{$tableName}`
                WHERE `session_id` = ?;
        ";
        return Db::getInstance()->queryOne($sql, [$session_id])['count'];
    }

    public function getProductsFromCart()
    {
        $session_id = session_id();
        $sql = "
            SELECT `cart`.`id`, `count`, `name`, `price`, `product_id`, `image` FROM `products` 
                INNER JOIN `cart` ON `products`.`id` = `cart`.`product_id` 
                WHERE `cart`.`session_id` = ? AND `count` != 0;
        ";
        return Db::getInstance()->queryAll($sql, [$session_id]);
    }

    public function getTableName()
    {
        return "cart";
    }

    public function getEntitiesName()
    {
        return CartModel::class;
    }
}