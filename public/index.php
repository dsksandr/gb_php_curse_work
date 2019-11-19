<?php
session_start();

use app\controllers\Controller;
use app\core\{Autoload, Request, Session, TwigRender};

try {
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
        $message = "Not found controller: {$controllerClass}. Url is incorrect ({$_SERVER['REQUEST_URI']}).";
        throw new Exception($message);
    }
} catch (\Exception $exception) {
    var_dump($exception);
}

