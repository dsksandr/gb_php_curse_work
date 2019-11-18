<?php

use app\controllers\Controller;
use app\core\Autoload;

session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    setcookie("hash");
    header('Location:' . $_SERVER['HTTP_REFERER']);
}

include realpath("../config/config.php");

spl_autoload_register([new Autoload(), 'loadClass']);

$url = explode('/', $_SERVER['REQUEST_URI']);

if ($url[1] === 'api') {
    $controllerName = $url[2];
    $type = $url[1];
} else {
    $controllerName = empty($url[1]) ? 'index' : $url[1];
}

$action = $_GET['action'];

$controllerClass = CTRL_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    /** @var Controller $controller */
    $controller = new $controllerClass([
        'type' => $type,
        'action' => $action
    ]);
} else {
    echo "404 controller";
}
