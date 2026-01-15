<?php
class Router {
    private $routes = [];

   
    public function add($route, $controllerAction, $protected = false) {
        $this->routes[$route] = [
            'action' => $controllerAction,
            'protected' => $protected
        ];
    }
   
    public function dispatch($uri) {
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$uri])) {
            $route = $this->routes[$uri];

           
            if ($route['protected'] && !Auth::check()) {
                header("Location: /login");
                exit;
            }
            list($controllerName, $method) = explode('@', $route['action']);

            $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $controller = new $controllerName();
                if (method_exists($controller, $method)) {
                    $controller->$method();
                } else {
                    echo "Method $method not found in controller $controllerName";
                }
            } else {
                echo "Controller file $controllerFile not found";
            }
        } else {
            http_response_code(404);
            echo "Page not found";
        }
    }
}
