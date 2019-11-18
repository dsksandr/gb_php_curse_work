<?php

namespace app\models;


use app\core\Db;

class CartModel extends DBModel
{
    public $sessionId;
    public $count;
    public $cart;

    /**
     * CartModel constructor.
     */
    public function __construct()
    {
        $this->sessionId = static::getSessionId();
        $this->count = static::getCartCount();
        $this->cart = $this->getProductsFromCart();
    }

    public static function getSessionId()
    {
        return session_id();
    }

    public static function changeProductCount($id, $quantity)
    {
        $session_id = static::getSessionId();
        $tableName = static::getTableName();
        $sql = "
            INSERT INTO `{$tableName}` (`product_id`, `session_id`) VALUES (?, ?)
                ON DUPLICATE KEY UPDATE `count` = `count` + ?;
        ";

        return Db::getInstance()->execute($sql, [$id, $session_id, $quantity]);
    }

    public static function getCartCount()
    {
        $session_id = static::getSessionId();
        $tableName = static::getTableName();
        $sql = "
            SELECT SUM(`count`) as count FROM `{$tableName}`
                WHERE `session_id` = ?;
        ";
        return Db::getInstance()->queryOne($sql, [$session_id])['count'];
    }

    public function getProductsFromCart()
    {
        $sql = "
            SELECT `cart`.`id`, `count`, `name`, `price`, `product_id`, `image` FROM `products` 
                INNER JOIN `cart` ON `products`.`id` = `cart`.`product_id` 
                WHERE `cart`.`session_id` = ? AND `count` != 0;
        ";
        return Db::getInstance()->queryAll($sql, [$this->sessionId]);
    }

    public static function getTableName()
    {
        return "cart";
    }
}
