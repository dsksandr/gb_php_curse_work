<?php


namespace app\controllers;


use app\core\Render;

class CartController extends Controller
{
    public function createParams($ctrlParams = [])
    {
        $twig = new Render([
                'page' => 'cart',
            ]
        );
        echo $twig->render();
    }

}