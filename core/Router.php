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

        // Debug information
        error_log("Dispatching URI: " . $uri);
        error_log("Request Method: " . $method);
        error_log("Available Routes: " . print_r($this->routes, true));

        // Remove base path from URI if needed
        $basePath = '/CMS_Sederhana/public';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        if (empty($uri)) {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            $pattern = $this->convertPathToRegex($route['path']);
            
            if (preg_match($pattern, $uri, $matches) && $route['method'] === $method) {
                array_shift($matches); // Remove the full match
                
                try {
                    $controller = new $route['controller']();
                    return call_user_func_array([$controller, $route['action']], $matches);
                } catch (Exception $e) {
                    error_log("Error in route dispatch: " . $e->getMessage());
                    throw $e;
                }
            }
        }

        // No route found
        error_log("No route found for: " . $uri);
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "<p>The requested URL was not found on this server.</p>";
        echo "<p>URI: " . htmlspecialchars($uri) . "</p>";
        echo "<p>Method: " . htmlspecialchars($method) . "</p>";
    }

    private function convertPathToRegex($path) {
        return '#^' . preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([^/]+)', $path) . '$#';
    }
} 