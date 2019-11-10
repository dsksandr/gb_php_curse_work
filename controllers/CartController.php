<?php


namespace app\controllers;

class CartController
{
    public function actionIndex()
    {
        //$basket = Basket::getBasket(session_id());
        echo $this->render('basket');
    }
}