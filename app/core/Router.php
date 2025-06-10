<?php
class Router
{
    private $routes = [];

    public function addRoute($method, $uri, $controller, $action, $middleware = [])
    {
        $this->routes[$method][$uri] = [
            'controller' => $controller,
            'action' => $action,
            'middleware' => (array) $middleware
        ];
    }

    public function direct($uri, $method)
    {
        // Hapus base path dari URI
        $basePath = '/CMS_Sederhana/public';
        $uri = str_replace($basePath, '', $uri);
        
        // Jika URI kosong, gunakan '/'
        if (empty($uri)) {
            $uri = '/';
        }

        // Cek apakah route eksplisit ada
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            
            // Jalankan middleware
            foreach ($route['middleware'] as $middlewareClass) {
                if (class_exists($middlewareClass)) {
                    $middlewareInstance = new $middlewareClass();
                    if (method_exists($middlewareInstance, 'handle')) {
                        $middlewareInstance->handle();
                    }
                } else {
                    // Handle error jika middleware tidak ditemukan
                    http_response_code(500);
                    echo "Middleware <b>{$middlewareClass}</b> tidak ditemukan.";
                    exit();
                }
            }

            $controllerName = $route['controller'];
            $methodName = $route['action'];
            $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $methodName)) {
                        // Middleware telah menangani session_start(), hapus dari controller jika duplikat
                        return $controller->$methodName();
                    }
                }
            }
        }

        // Jika route tidak ditemukan (jika tidak ada dalam definisi eksplisit)
        // Atau jika menggunakan routing dinamis (tidak melalui addRoute)
        $uriSegments = explode('/', trim($uri, '/'));
        $controllerName = !empty($uriSegments[0]) ? ucfirst($uriSegments[0]) . 'Controller' : 'PostController';
        $methodName = isset($uriSegments[1]) ? $uriSegments[1] : 'index';
        $params = array_slice($uriSegments, 2);

        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    return call_user_func_array([$controller, $methodName], $params);
                }
            }
        }

        http_response_code(404);
        echo "404 - Halaman tidak ditemukan";
    }
}