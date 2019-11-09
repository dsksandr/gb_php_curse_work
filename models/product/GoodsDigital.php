<?php


namespace app\models\product;


class GoodsDigital extends Product
{
    public $name = 'Цифровой товар';

    public function setPrice(): int
    {
        return $this->price / 2;
    }
}