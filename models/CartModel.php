<?php

namespace app\models;


class CartModel extends DBModel
{
    public $id;
    public $session_id;
    public $goods_id;

    /**
     * Basket constructor.
     * @param $session_id
     * @param $goods_id
     */
    public function __construct($session_id = null, $goods_id = null)
    {
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
    }


    public static function getTableName()
    {
        return "basket";
    }

}