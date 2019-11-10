<?php


namespace app\controllers;


use app\core\Render;

class IndexController extends Controller
{
    public function createParams()
    {
        $this->params['page'] = 'index';

        $twig = new Render($this->params);
        echo $twig->render();
    }
}