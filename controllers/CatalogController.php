<?php


namespace app\controllers;


use app\models\repositories\ProductRepository;

class CatalogController extends Controller
{
    function createParams()
    {
        $this->params['page'] = 'catalog';
        $this->params['catalog'] = (new ProductRepository())->getAll();

        echo $this->renderer->render($this->params);
    }
}