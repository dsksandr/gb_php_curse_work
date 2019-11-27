<?php


namespace app\core;


use app\interfaces\IRender;
use Twig\Environment;
use Twig\Error\{LoaderError, RuntimeError, SyntaxError};
use Twig\Loader\FilesystemLoader;

class TwigRender implements IRender
{
    private $twig;
    private $loader;
    private $template = 'main.twig';

    public function __construct()
    {
        $dir_tpl = App::call()->config['dir_tpl'];
        $paths =  array_merge(
            [$dir_tpl],
            glob($dir_tpl . DIRECTORY_SEPARATOR . '*' , GLOB_ONLYDIR)
        );
        $this->loader = new FilesystemLoader($paths);
        $this->twig = new Environment($this->loader, []);
    }

    /**
     * @param $params
     * @return mixed
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render($params)
    {
        return $this->twig->render($this->template, $params);
    }
}