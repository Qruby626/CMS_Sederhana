<?php
class Router
{
    private $routes = [
        'GET' => [
            '/' => ['PostController', 'index'],
            '/login' => ['AuthController', 'login'],
            '/logout' => ['AuthController', 'logout'],
            '/dashboard' => ['DashboardController', 'index'],
            '/posts' => ['PostController', 'index'],
            '/posts/create' => ['PostController', 'create'],
            '/categories' => ['CategoryController', 'index'],
            '/create-admin' => ['AuthController', 'createAdmin']
        ],
        'POST' => [
            '/login' => ['AuthController', 'login'],
            '/create-admin' => ['AuthController', 'createAdmin'],
            '/posts/create' => ['PostController', 'store']
        ]
    ];

    public function direct($uri, $method)
    {
        // Hapus base path dari URI
        $basePath = '/CMS_Sederhana/public';
        $uri = str_replace($basePath, '', $uri);
        
        // Jika URI kosong, gunakan '/'
        if (empty($uri)) {
            $uri = '/';
        }

        // Cek apakah route ada
        if (isset($this->routes[$method][$uri])) {
            [$controllerName, $methodName] = $this->routes[$method][$uri];
            $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $methodName)) {
                        return $controller->$methodName();
                    }
                }
            }
        }

        // Jika route tidak ditemukan
        http_response_code(404);
        echo "404 - Halaman tidak ditemukan";
    }
}