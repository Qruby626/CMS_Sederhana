<?php
class Router {
    private $routes = [];

    public function add($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $pattern = $this->convertPathToRegex($route['path']);
            
            if (preg_match($pattern, $uri, $matches) && $route['method'] === $method) {
                array_shift($matches); // Remove the full match
                
                $controller = new $route['controller']();
                return call_user_func_array([$controller, $route['action']], $matches);
            }
        }

        // No route found
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }

    private function convertPathToRegex($path) {
        return '#^' . preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([^/]+)', $path) . '$#';
    }
} 