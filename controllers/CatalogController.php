<?php


namespace app\controllers;


use app\core\Render;
use app\models\ProductModel;

class CatalogController extends Controller
{
    function createParams($ctrlParams = [])
    {
        $catalog = ProductModel::getAll();
        var_dump($catalog);
        $twig = new Render([
                'page' => 'catalog',
                'catalog' => $catalog
            ]
        );
        echo $twig->render();
    }
}