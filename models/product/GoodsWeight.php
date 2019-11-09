<?php


namespace app\models\product;


use app\core\Db;

class GoodsWeight extends Product
{
    public $name = 'Товар на разновес';
    public $count;

    public function __construct(Db $db, $count = 0)
    {
        parent::__construct($db);
        $this->count = $count;
    }

    public function setPrice(): int
    {
        return $this->price * $this->count;
    }
}