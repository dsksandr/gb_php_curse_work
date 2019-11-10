<?php


namespace app\controllers;


use app\interfaces\IController;

abstract class Controller implements IController
{
    protected $ctrlParams;

    public function __construct($ctrlParams = [])
    {
        $this->ctrlParams = $ctrlParams;
        $this->createParams($this->ctrlParams);
    }
}