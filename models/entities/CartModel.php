<?php

namespace app\models\entities;


use app\models\Model;

class CartModel extends Model
{
    public $sessionId;
    public $count;
    public $cart;

    /**
     * CartModel constructor.
     */
    public function __construct()
    {

    }


}
