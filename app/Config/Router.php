<?php

function load(string $controller, string $action, ...$params)
{
    try {
        $controllerNameSpace = "app\\Controllers\\{$controller}";

        if (!class_exists($controllerNameSpace)) {
            throw new \Exception("Controller {$controllerNameSpace} not found");
        }

        $controllerInstance = new $controllerNameSpace();

        if (!method_exists($controllerInstance, $action)) {
            throw new \Exception("Action {$action} not found");
        }

        call_user_func_array([$controllerInstance, $action], $params);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


$router = [
    "GET" => [
        '/' => fn() => load("Movies", "index"),
        '/movie/([0-9]+)' => fn($filmId) => load("Movies", "movieIndex", $filmId),
        '/movies' => fn() => load("Movies", "getMovies"),
        '/movies/([0-9]+)' => fn($filmId) => load("Movies", "getMovie", $filmId),
        '/docs' => fn() => load("Movies", "docs"),
        '/translations' => fn() => load("Movies", "getTranslations")
    ]
];
