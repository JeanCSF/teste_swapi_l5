<?php
require '../vendor/autoload.php';
require '../app/Config/Router.php';
require '../app/Config/Config.php';

try {
  $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
  $request = $_SERVER['REQUEST_METHOD'];

  if (!isset($router[$request])) {
    throw new \Exception("Method not allowed");
  }

  $matchedRoute = null;
  foreach ($router[$request] as $routePattern => $handler) {
    if (preg_match('#^' . $routePattern . '$#', $uri, $matches)) {
      $matchedRoute = $handler;
      break;
    }
  }

  if (!$matchedRoute) {
    throw new \Exception("URI not found");
  }

  if (is_callable($matchedRoute)) {
    call_user_func_array($matchedRoute, $matches ? array_slice($matches, 1) : []);
  } else {

    $routeParams = $matches ? array_slice($matches, 1) : [];

    list($controllerName, $methodName) = explode('@', $matchedRoute);

    $controller = new $controllerName();

    call_user_func_array([$controller, $methodName], $routeParams);
  }
} catch (\Exception $e) {
  echo $e->getMessage();
}
 