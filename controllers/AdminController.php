<?php


namespace app\controllers;


use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;

class AdminController extends Controller
{
    function createParams()
    {
        $this->params['page'] = 'admin';
        $this->params['orders'] = (new OrderRepository())->getAll();
        $this->params['statuses'] = (new OrderRepository())->getOrderStatus();

        echo $this->renderer->render($this->params);
    }
}