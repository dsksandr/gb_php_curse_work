<?php


namespace app\controllers;


use app\interfaces\IController;

abstract class Controller implements IController
{
    public $params;

    public function __construct($params = [])
    {
        $this->params = $params;

        if ($this->$params['type'] !== 'api') {
            if (AuthController::isAuth()) {
                $this->params['allow'] = true;
                $this->params['user'] = AuthController::getUser();
            } else {
                $this->params['allow'] = false;
            }
        }

        $this->createParams();
    }
}