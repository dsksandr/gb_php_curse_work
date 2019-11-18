<?php


namespace app\controllers;


use app\interfaces\IController;
use app\models\CartModel;

abstract class Controller implements IController
{
    public $params;
    public $request;
    public $session;

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->request = $params['request'];
        $this->session = $params['session'];
        $this->init();
    }

    protected function init()
    {
        if ($this->params['type'] !== 'api') {

            if (AuthController::isAuth($this->session)) {
                $this->params['allow'] = true;
                $this->params['user'] = $this->session['login'];
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