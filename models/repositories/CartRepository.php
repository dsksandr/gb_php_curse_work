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
            INSERT INTO cart (`product_id`, `session_id`) VALUES (?, ?)
                ON DUPLICATE KEY UPDATE `count` = `count` + ?;
        ";

        return Db::getInstance()->execute($sql, [$id, $session_id, $quantity]);
    }
    public function getCartSum() {
        $sql = <<<SQL
            select sum(price * cart.count) as total from products
                inner join cart on products.id = cart.product_id
                where cart.session_id = ? and cart.order_id is null and count != 0;
        SQL;
        $params = [session_id()];
        return Db::getInstance()->queryOne($sql, $params)['total'];
    }

    public function getCartCount()
    {
        $session_id = session_id();
        $sql = "
            SELECT SUM(`count`) as count FROM cart
                WHERE `session_id` = ? and order_id is null;
        ";
        return Db::getInstance()->queryOne($sql, [$session_id])['count'];
    }

    public function getProductsFromCart()
    {
        $session_id = session_id();
        $sql = "
            SELECT `cart`.`id`, `count`, `name`, `price`, `product_id`, `image` FROM `products` 
                INNER JOIN `cart` ON `products`.`id` = `cart`.`product_id` 
                WHERE `cart`.`session_id` = ? AND `order_id` IS NULL AND `count` != 0;
        ";
        return Db::getInstance()->queryAll($sql, [$session_id]);
    }

    public function addOrderNumber($sessionId, $orderNumber)
    {
        $sql = <<<SQL
            update cart
                set order_id = ?
                where session_id = ? and order_id IS NULL and count != 0;
        SQL;
        $params = [$orderNumber, $sessionId];

        Db::getInstance()->execute($sql, $params);
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