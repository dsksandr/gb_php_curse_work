<?php

namespace app\controllers;


use app\models\repositories\ProductRepository;

class ProductController extends Controller
{
    public function createParams()
    {
        $this->params['page'] = 'product';
        $this->params['product'] = (new ProductRepository())->getOne($this->request->getParams()['id']);

        echo $this->renderer->render($this->params);
    }
}