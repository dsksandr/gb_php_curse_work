<?php

namespace app\models\entities;


use app\models\Model;

class UserModel extends Model
{
    protected $id;
    protected $login;
    protected $password;
    protected $hash;

    protected $props = [
        'id' => false,
        'login' => false,
        'password' => false,
        'hash' => false,
    ];

    public function __construct(
        $id = null,
        $login = null,
        $password = null,
        $hash = null)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->hash = $hash;
    }

}