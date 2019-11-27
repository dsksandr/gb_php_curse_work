<?php


namespace app\controllers;


use app\core\App;
use app\interfaces\IController;
use app\interfaces\IRender;

abstract
class Controller implements IController
{
    public $params;
    public $renderer;

    /**
     * Controller constructor.
     * @param IRender $render
     */
    public
    function __construct(
        IRender $render
    )
    {
        $this->renderer = $render;

        $this->init();
    }

    protected
    function init()
    {
        App::call()->session;

        switch (App::call()->request->getType() === 'api') {
            case true:
                $this->formApiAnswer();
                break;

            case false:

                if (App::call()->userRepository->isAuth()) {

                    $this->params['allow'] = true;
                    $this->params['user'] = App::call()->session->getUserLogin();
                    $this->params['access'] = App::call()->session->getUserAccess();

                } else {

                    $this->params['allow'] = false;

                }

                $this->params['cart_count'] = App::call()->cartRepository->getCartCount();
                $this->params['cart_sum'] = App::call()->cartRepository->getCartSum();

                $this->createParams();
                break;
        }
    }
}