<?php

namespace app\controllers;


use app\models\ProductModel;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $catalog = ProductModel::getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
    }

    public function actionApiCatalog()
    {
        $catalog = ProductModel::getAll();
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $product = ProductModel::getOne($id);
        echo $this->render('card', ['product' => $product]);
    }

}