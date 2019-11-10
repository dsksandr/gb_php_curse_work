<?php


namespace app\controllers;


use app\core\Render;

class CartController extends Controller
{
    public function createParams()
    {
        $this->params['page'] = 'cart';

        $twig = new Render($this->params);
        echo $twig->render();
    }

}