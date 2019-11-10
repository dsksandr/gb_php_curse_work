<?php


namespace app\core;


use app\interfaces\IRender;

class Render implements IRender
{
    public function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        $templatePath = TPL_DIR . $template . ".php";
        if (file_exists($templatePath)) {
            include $templatePath;
        }
        return ob_get_clean();
    }
}