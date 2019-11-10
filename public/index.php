<?php

use app\core\{Autoload};
use app\core\Render;
use app\models\{ProductModel};

include realpath("../config/config.php");
include realpath("../core/Autoload.php");

spl_autoload_register([new Autoload(), 'loadClass']);

$url = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = empty($url[1]) ? 'product' : $url[1];
$actionName = $url[2];

$controllerClass = CTRL_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
} else {
    echo "404 controller";
}

/** @var ProductModel $product */

//$product = new Product("Пицца","Описание", 125, "1.jpg");

//$product = new Product();
//

//$product->delete();

/*
$product = Product::getOne(5);
$product->name = "Чай";
$product->save();
//$product->getWere('session_id', session_id());
*/




