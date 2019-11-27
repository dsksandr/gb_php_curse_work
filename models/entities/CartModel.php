<?php

namespace app\models\entities;


use app\models\Model;

class CartModel extends Model
{
    protected $sessionId;
    protected $count;
    protected $cart;
    protected $order_num;

    protected $props = [
        'session_id' => false,
        'count' => false,
        'cart' => false,
        'order_num' => false,
    ];

    /**
     * CartModel constructor.
     */
    public
    function __construct()
    {
    }
}
