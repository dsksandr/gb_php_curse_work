<?php

namespace app\models;


use app\core\DB;

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
        $this->count = $this->getCartCount();
        $this->cart = $this->getProductsFromCart();
    }

    public static function getSessionId()
    {
        return session_id();
    }

    public static function addToCart($id)
    {
        $session_id = static::getSessionId();
        $tableName = static::getTableName();
        $sql = "
            INSERT INTO `{$tableName}` (`product_id`, `session_id`) VALUES (?, ?)
                ON DUPLICATE KEY UPDATE `count` = `count` + 1;
        ";

        return DB::getInstance()->execute($sql, [$id, $session_id]);
    }

    public function getCartCount()
    {
        $tableName = static::getTableName();
        $sql = "
            SELECT SUM(`count`) as count FROM `{$tableName}`
                WHERE `session_id` = ?;
        ";
        return DB::getInstance()->queryAll($sql, [$this->sessionId]);
    }

    public function getProductsFromCart()
    {
        $sql = "
            SELECT `cart`.`id`, `count`, `name`, `price`, `product_id`, `image` FROM `products` 
                INNER JOIN `cart` ON `products`.`id` = `cart`.`product_id` 
                WHERE `cart`.`session_id` = ?;
        ";
        return DB::getInstance()->queryAll($sql, [$this->sessionId]);
    }

    public function deleteProductFromCart($id)
    {
        $id = (int)$id;
        $session_id = session_id();

        $sql_update = "
        UPDATE `cart` 
            SET `count` = `count` - 1
            WHERE `product_id` = '{$id}' AND `session_id` = '{$session_id}';
    ";
        $sql_delete = "
        DELETE FROM `cart` 
            WHERE `count` = 0;
    ";

        executeQueryToDB($sql_update);
        executeQueryToDB($sql_delete);

        return true;
    }

    public static function getTableName()
    {
        return "cart";
    }
}