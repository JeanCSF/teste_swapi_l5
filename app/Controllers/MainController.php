<?php

namespace app\Controllers;

use League\Plates\Engine;

class MainController
{
    public static function view(string $view, array $data = [])
    {
        
        $viewsPath = realpath(dirname(__FILE__, 2) . '/views');

        if (!file_exists($viewsPath . DIRECTORY_SEPARATOR . $view . '.php')) {
            throw new \Exception("View {$view} not found");
        }

        $templates = new Engine($viewsPath);
        echo $templates->render($view, $data);
    }
}
