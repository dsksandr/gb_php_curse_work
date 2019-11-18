<?php


namespace app\controllers;


use app\interfaces\IController;
use app\models\CartModel;

abstract class Controller implements IController
{
    public $params;

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->init();
    }

    protected function init()
    {
        if ($this->params['type'] !== 'api') {
            if (AuthController::isAuth()) {
                $this->params['allow'] = true;
                $this->params['user'] = AuthController::getUser();
            } else {
                $this->params['allow'] = false;
            }

            $this->params['cart_count'] = CartModel::getCartCount();

            $this->createParams();
        } else {

            $this->formApiAnswer();
        }
    }
}