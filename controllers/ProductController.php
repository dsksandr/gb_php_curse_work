<?php

namespace app\controllers;


use app\models\ProductModel;

class ProductController extends Controller
{
    public function createParams()
    {
        $this->params['page'] = 'product';
        $this->params['product'] = ProductModel::getOne($this->request->getParams()['id']);

        echo $this->renderer->render($this->params);
    }
}