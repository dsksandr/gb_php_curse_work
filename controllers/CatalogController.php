<?php


namespace app\controllers;


use app\core\App;

class CatalogController extends Controller
{
    public
    function createParams()
    {
        $this->params['page'] = 'catalog';
        $this->params['catalog'] = App::call()->productRepository->getAll();

        echo $this->renderer->render($this->params);
    }
}