<?php


namespace app\models\repositories;


use app\core\App;
use app\models\entities\CartModel;
use app\models\Repository;

class CartRepository extends Repository
{
    public
    function changeProductCount($id, $quantity)
    {
        $sql = <<<SQL
            insert into cart (`product_id`, `session_id`) values (?, ?)
                on duplicate key update `count` = `count` + ?;
        SQL;
        $params = [
            $id,
            App::call()->session->getSessionID(),
            $quantity
        ];

        return App::call()->db->execute($sql, $params);
    }

    public
    function getCartSum()
    {
        $sql = <<<SQL
            select sum(price * cart.count) as total from products
                inner join cart on products.id = cart.product_id
                where cart.session_id = ? and cart.order_id is null and count != 0;
        SQL;
        $params = [App::call()->session->getSessionID()];

        return App::call()->db->queryOne($sql, $params)['total'];
    }

    public
    function getCartCount()
    {
        $sql = <<<SQL
            select sum(`count`) as count from cart
                where `session_id` = ? and order_id is null;
        SQL;
        $params = [App::call()->session->getSessionID()];

        return App::call()->db->queryOne($sql, $params)['count'];
    }

    public
    function getProductsFromCart()
    {
        $sql = <<<SQL
            select `cart`.`id`, `count`, `name`, `price`, `product_id`, `image` from `products` 
                inner join `cart` on `products`.`id` = `cart`.`product_id` 
                where `cart`.`session_id` = ? and `order_id` is null and `count` != 0;
        SQL;
        $params = [App::call()->session->getSessionID()];

        return App::call()->db->queryAll($sql, $params);
    }

    public
    function addOrderNumber($orderNumber)
    {
        $sql = <<<SQL
            update cart
                set order_id = ?
                where session_id = ? and order_id IS NULL and count != 0;
        SQL;
        $params = [$orderNumber, App::call()->session->getSessionID()];

        App::call()->db->execute($sql, $params);
    }

    public
    function getTableName()
    {
        return "cart";
    }

    public
    function getEntitiesName()
    {
        return CartModel::class;
    }
}