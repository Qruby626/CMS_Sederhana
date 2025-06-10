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

        // Determine the base path (e.g., /CMS_Sederhana/public)
        // This is crucial for environments where the app is in a subfolder.
        $scriptName = $_SERVER['SCRIPT_NAME']; // e.g., /CMS_Sederhana/public/index.php
        $basePath = dirname($scriptName); // e.g., /CMS_Sederhana/public

        // Ensure base path ends without a slash if it's not the root
        if ($basePath !== '/' && substr($basePath, -1) === '/') {
            $basePath = substr($basePath, 0, -1);
        }

        // Remove the base path from the URI
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // If after stripping, URI is empty, it means we are at the base route (e.g., /CMS_Sederhana/public/ or /CMS_Sederhana/)
        if (empty($uri)) {
            $uri = '/';
        }

        // Normalize URI: remove trailing slash unless it's just '/'
        if (strlen($uri) > 1 && substr($uri, -1) === '/') {
            $uri = substr($uri, 0, -1);
        }

        // Debug information
        error_log("Original URI: " . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        error_log("Calculated Base Path: " . $basePath);
        error_log("Cleaned URI for routing: " . $uri);
        error_log("Request Method: " . $method);
        error_log("Available Routes: " . print_r($this->routes, true));

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