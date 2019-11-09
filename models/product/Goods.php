<?php


namespace app\models\product;


class Goods extends Product
{
    public $name = 'Простой товар';

    public function setPrice(): int
    {
        return $this->price;
    }
}