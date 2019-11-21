<?php


namespace app\models\entities;


use app\models\Model;

class OrderModel extends Model
{
    protected $id;
    protected $session_id;
    protected $email;
    protected $status;

    protected $props = [
        'session_id' => false,
        'email' => false,
    ];

    public function __construct(
        $session_id = null,
        $email = null
    )
    {
        $this->session_id = $session_id;
        $this->email = $email;
    }
}