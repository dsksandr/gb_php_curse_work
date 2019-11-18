<?php

namespace app\controllers;


use app\core\Render;
use app\models\ProductModel;

class ProductController extends Controller
{
    public function createParams()
    {
        $this->params['page'] = 'product';
        $this->params['product'] = ProductModel::getOne($this->request['id']);

        $twig = new Render($this->params);
        echo $twig->render();
    }
}