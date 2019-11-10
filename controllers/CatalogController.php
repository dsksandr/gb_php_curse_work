<?php


namespace app\controllers;


use app\core\Render;
use app\models\ProductModel;

class CatalogController extends Controller
{
    function createParams()
    {
        $this->params['page'] = 'catalog';
        $this->params['catalog'] = ProductModel::getAll();

        $twig = new Render($this->params);
        echo $twig->render();
    }
}