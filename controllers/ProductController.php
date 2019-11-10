<?php

namespace app\controllers;


use app\core\Render;
use app\models\ProductModel;

class ProductController extends Controller
{
    public function createParams($ctrlParams = [])
    {
        $id = $_GET['id'];
        $product = ProductModel::getOne($id);
        $twig = new Render([
                'page' => 'product',
                'product' => $product
            ]
        );
        echo $twig->render();
    }
}