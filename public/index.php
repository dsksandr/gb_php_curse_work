<?php

use app\core\Db;
use app\models\{Cart, Users};
use app\models\product\{Goods, GoodsDigital, GoodsWeight, Renderer};

define('DS', DIRECTORY_SEPARATOR);
include dirname(__DIR__) . DS . 'core' . DS . "Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$goods = new Goods(new Db());
$goodsWeight = new GoodsWeight(new Db(), 3);
$goodsDigital = new GoodsDigital(new Db());
$users = new Users(new Db());
$cart = new Cart(new Db());

function foo(Renderer $product)
{
    return $product->showInfo();
}

echo foo($goods) . '<br>';
echo foo($goodsWeight) . '<br>';
echo foo($goodsDigital) . '<br>';

//echo $product->getOne(1);
