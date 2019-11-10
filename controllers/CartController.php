<?php


namespace app\controllers;


class CartController extends Controller
{

    public function actionIndex()
    {
        //$basket = Basket::getBasket(session_id());
        echo $this->render('cart');
    }

}