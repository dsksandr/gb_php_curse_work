<?php

use app\controllers\Controller;
use app\core\Autoload;

include realpath("../config/config.php");

spl_autoload_register([new Autoload(), 'loadClass']);

$url = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = empty($url[1]) ? 'index' : $url[1];

$controllerClass = CTRL_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    /** @var Controller $controller */
    $controller = new $controllerClass();
} else {
    echo "404 controller";
}
