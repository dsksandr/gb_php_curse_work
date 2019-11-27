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
        'status' => false,
    ];

    public
    function __construct(
        $id = null,
        $session_id = null,
        $email = null,
        $status = null
    )
    {
        $this->id = $id;
        $this->session_id = $session_id;
        $this->email = $email;
        $this->status = $status;
    }

    public
    function getID()
    {
        return $this->id;
    }
}