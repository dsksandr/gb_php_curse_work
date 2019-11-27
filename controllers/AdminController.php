<?php


namespace app\controllers;


use app\core\App;

class AdminController extends Controller
{
    public
    function createParams()
    {
        if (App::call()->session->getUserAccess() === 'admin') {

            $this->params['page'] = 'admin';
            $this->params['orders'] = App::call()->orderRepository->getAll();
            $this->params['statuses'] = App::call()->orderRepository->getOrderStatus();

            echo $this->renderer->render($this->params);

        } else {

            header('Location: /');

        }
    }
}