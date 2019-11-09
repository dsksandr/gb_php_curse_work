<?php


namespace app\interfaces;


interface IModels
{
    public function getItem($id);

    public function getAll();

    public function getTableName();
}