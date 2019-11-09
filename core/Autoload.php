<?php


class Autoload
{
    public function loadClass($className)
    {
        $fileName = str_replace(['app', '\\'], [ dirname(__DIR__), DS], $className) . '.php';

        if (file_exists($fileName)) {
            var_dump($fileName);
            include $fileName;
        }
    }
}