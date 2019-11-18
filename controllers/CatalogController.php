<?php


namespace app\controllers;


use app\models\ProductModel;

class CatalogController extends Controller
{
    function createParams()
    {
        $this->params['page'] = 'catalog';
        $this->params['catalog'] = ProductModel::getAll();

        echo $this->renderer->render($this->params);
    }
}