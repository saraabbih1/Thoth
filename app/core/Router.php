<?php

class Router
{
    private $routes = [];

    public function get($path, $action)
    {
        $this->routes['GET'][$path] = $action;
    }

    public function post($path, $action)
    {
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch($uri)
    {
        $path = parse_url($uri, PHP_URL_PATH); // /students
        $method = $_SERVER['REQUEST_METHOD']; // GET
        $action = $this->routes[$method][$path] ?? null; // ['basecontroler', 'students']

        if (!$action) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        $controllerName = $action[0];

        $methodName = $action[1];

        require_once __DIR__ . '/../controllers/' . $controllerName . '.php';

        $controller = new $controllerName();
        $controller->$methodName();
    }
}