<?php


namespace app\controllers;


use app\core\Render;

class IndexController extends Controller
{
    public function createParams($ctrlParams = [])
    {
        $twig = new Render([
                'page' => 'index',
            ]
        );
        echo $twig->render();
    }
}