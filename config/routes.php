<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

$router = new Router();

// Auth routes
$router->add('GET', '/login', 'AuthController', 'login');
$router->add('POST', '/login', 'AuthController', 'login');
$router->add('GET', '/register', 'AuthController', 'register');
$router->add('POST', '/register', 'AuthController', 'register');
$router->add('GET', '/logout', 'AuthController', 'logout');

// Category routes
$router->add('GET', '/categories', 'CategoryController', 'index');
$router->add('GET', '/categories/create', 'CategoryController', 'create');
$router->add('POST', '/categories/create', 'CategoryController', 'create');
$router->add('GET', '/categories/edit/{id}', 'CategoryController', 'edit');
$router->add('POST', '/categories/edit/{id}', 'CategoryController', 'edit');
$router->add('GET', '/categories/delete/{id}', 'CategoryController', 'delete');

// Post routes
$router->add('GET', '/posts', 'PostController', 'index');
$router->add('GET', '/posts/create', 'PostController', 'create');
$router->add('POST', '/posts/create', 'PostController', 'create');
$router->add('GET', '/posts/edit/{id}', 'PostController', 'edit');
$router->add('POST', '/posts/edit/{id}', 'PostController', 'edit');
$router->add('GET', '/posts/delete/{id}', 'PostController', 'delete');

// Home route
$router->add('GET', '/', 'PostController', 'index');

return $router; 