<?php


namespace app\models\product;

use app\interfaces\IProduct;
use app\models\Model;


abstract class Product extends Model implements IProduct
{
    public $id;
    public $name;
    public $description;
    public $price = 10;

    public function getTableName(): string
    {
        return "products";
    }

    public function formPrices(): float
    {
        return $this->setPrice() * 1.25;
    }

    public function showInfo(): string
    {
        return 'Товар: ' . $this->name . ' Цена: ' . $this->formPrices();
    }
}
