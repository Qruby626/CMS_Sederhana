<?php
spl_autoload_register(function ($class) {
    $paths = [
        'app/core/',
        'app/models/',
        'app/controllers/',
        'app/middleware/'
    ];

    foreach ($paths as $path) {
        $file = __DIR__ . '/../' . $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$router = new Router();

// Public Routes (tidak memerlukan autentikasi)
$router->addRoute('GET', '/login', 'AuthController', 'login');
$router->addRoute('POST', '/login', 'AuthController', 'login');
$router->addRoute('GET', '/logout', 'AuthController', 'logout');
$router->addRoute('GET', '/create-admin', 'AuthController', 'createAdmin');
$router->addRoute('POST', '/create-admin', 'AuthController', 'createAdmin');

// Protected Routes (memerlukan autentikasi)
$router->addRoute('GET', '/', 'DashboardController', 'index', 'AuthMiddleware');
$router->addRoute('GET', '/dashboard', 'DashboardController', 'index', 'AuthMiddleware');

// Posts Routes
$router->addRoute('GET', '/posts', 'PostController', 'index', 'AuthMiddleware');
$router->addRoute('GET', '/posts/create', 'PostController', 'create', 'AuthMiddleware');
$router->addRoute('POST', '/posts/create', 'PostController', 'store', 'AuthMiddleware');
$router->addRoute('GET', '/posts/edit/{id}', 'PostController', 'edit', 'AuthMiddleware');
$router->addRoute('POST', '/posts/update/{id}', 'PostController', 'update', 'AuthMiddleware');
$router->addRoute('GET', '/posts/delete/{id}', 'PostController', 'delete', 'AuthMiddleware');

// Categories Routes
$router->addRoute('GET', '/categories', 'CategoryController', 'index', 'AuthMiddleware');
$router->addRoute('GET', '/categories/create', 'CategoryController', 'create', 'AuthMiddleware');
$router->addRoute('POST', '/categories/create', 'CategoryController', 'store', 'AuthMiddleware');
$router->addRoute('GET', '/categories/edit/{id}', 'CategoryController', 'edit', 'AuthMiddleware');
$router->addRoute('POST', '/categories/update/{id}', 'CategoryController', 'update', 'AuthMiddleware');
$router->addRoute('GET', '/categories/delete/{id}', 'CategoryController', 'delete', 'AuthMiddleware');

// Comments Routes
$router->addRoute('GET', '/comments', 'CommentsController', 'index', 'AuthMiddleware');
$router->addRoute('GET', '/comments/create', 'CommentsController', 'create', 'AuthMiddleware');
$router->addRoute('POST', '/comments/create', 'CommentsController', 'store', 'AuthMiddleware');

// Dispatch the request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->direct($uri, $method);
