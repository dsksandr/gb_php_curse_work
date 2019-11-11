<?php


namespace app\core;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Render
{
    private $twig;
    private $loader;
    private $template = 'main.twig';
    private $params;

    public function __construct($params)
    {
        $paths =  array_merge(
            [TPL_DIR],
            glob(TPL_DIR . DS . '*' , GLOB_ONLYDIR)
        );
        $this->loader = new FilesystemLoader($paths);
        $this->twig = new Environment($this->loader, []);
        $this->params = $params;
    }

    public function render()
    {
//        var_dump($this->params);
        return $this->twig->render($this->template, $this->params);
    }
}