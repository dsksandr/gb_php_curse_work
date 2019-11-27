<?php

namespace app\controllers;


use app\core\App;

class ProductController extends Controller
{
    public
    function createParams()
    {

        $this->params['page'] = 'product';

        $id = App::call()->request->getParams()['id'];
        $this->params['product'] = App::call()->productRepository->getOne($id);

        echo $this->renderer->render($this->params);
    }
}