<?php


namespace app\core;


use app\interfaces\IRender;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRender implements IRender
{
    private $twig;
    private $loader;
    private $template = 'main.twig';

    public function __construct()
    {
        $paths =  array_merge(
            [TPL_DIR],
            glob(TPL_DIR . DS . '*' , GLOB_ONLYDIR)
        );
        $this->loader = new FilesystemLoader($paths);
        $this->twig = new Environment($this->loader, []);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function render($params)
    {
        return $this->twig->render($this->template, $params);
    }
}