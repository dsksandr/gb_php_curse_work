<?php


namespace app\core;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Render
{
    private $twig;
    private $loader;
    private $template = 'layouts' . DS . 'main.twig';
    private $params;

    public function __construct($params)
    {
        $this->loader = new FilesystemLoader(TPL_DIR);
        $this->twig = new Environment($this->loader, []);
        $this->params = $params;
    }

    public function render()
    {
//        var_dump($this->params);
        return $this->twig->render($this->template, $this->params);
    }
}