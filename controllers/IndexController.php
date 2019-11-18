<?php


namespace app\controllers;


class IndexController extends Controller
{
    public function createParams()
    {
        $this->params['page'] = 'index';

        echo $this->renderer->render($this->params);
    }
}