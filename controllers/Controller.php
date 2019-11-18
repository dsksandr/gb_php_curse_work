<?php


namespace app\controllers;


use app\core\Request;
use app\core\Session;
use app\interfaces\IController;
use app\interfaces\IRender;
use app\models\CartModel;

abstract class Controller implements IController
{
    public $params;
    public $request;
    public $session;
    public $renderer;

    /**
     * Controller constructor.
     * @param Session $session
     * @param Request $request
     * @param IRender $render
     */
    public function __construct(
        Session $session,
        Request $request,
        IRender $render
    )
    {
        $this->request = $request;
        $this->session = $session;
        $this->renderer = $render;

        $this->init();
    }

    protected function init()
    {
        if ($this->request->getType() !== 'api') {
            if (AuthController::isAuth($this->session)) {
                $this->params['allow'] = true;
                $this->params['user'] = $this->session->getUserLogin();
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