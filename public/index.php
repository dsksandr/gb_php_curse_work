<?php
session_start();

use app\controllers\Controller;
use app\core\{Autoload, TwigRender, Request, Session};

include realpath("../config/config.php");

spl_autoload_register([new Autoload(), 'loadClass']);

$request = new Request();

$controllerClass = CTRL_NAMESPACE . ucfirst($request->getControllerName()) . "Controller";

if (class_exists($controllerClass)) {
    /** @var Controller $controller */
    $controller = new $controllerClass(
        new Session(),
        $request,
        new TwigRender()
    );
} else {
    echo "404 controller";
}
