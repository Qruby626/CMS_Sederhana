<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';

$router = new Router();

// Auth routes
$router->add('GET', '/CMS_Sederhana/auth/login', 'AuthController', 'login');
$router->add('POST', '/CMS_Sederhana/auth/login', 'AuthController', 'login');
$router->add('GET', '/CMS_Sederhana/auth/register', 'AuthController', 'register');
$router->add('POST', '/CMS_Sederhana/auth/register', 'AuthController', 'register');
$router->add('GET', '/CMS_Sederhana/auth/logout', 'AuthController', 'logout');

// Dashboard route
$router->add('GET', '/CMS_Sederhana/dashboard', 'DashboardController', 'index');

// Category routes
$router->add('GET', '/CMS_Sederhana/categories', 'CategoryController', 'index');
$router->add('GET', '/CMS_Sederhana/categories/create', 'CategoryController', 'create');
$router->add('POST', '/CMS_Sederhana/categories/create', 'CategoryController', 'create');
$router->add('GET', '/CMS_Sederhana/categories/edit/{id}', 'CategoryController', 'edit');
$router->add('POST', '/CMS_Sederhana/categories/edit/{id}', 'CategoryController', 'edit');
$router->add('GET', '/CMS_Sederhana/categories/delete/{id}', 'CategoryController', 'delete');

// Post routes
$router->add('GET', '/CMS_Sederhana/posts', 'PostController', 'index');
$router->add('GET', '/CMS_Sederhana/posts/create', 'PostController', 'create');
$router->add('POST', '/CMS_Sederhana/posts/create', 'PostController', 'create');
$router->add('GET', '/CMS_Sederhana/posts/edit/{id}', 'PostController', 'edit');
$router->add('POST', '/CMS_Sederhana/posts/edit/{id}', 'PostController', 'edit');
$router->add('GET', '/CMS_Sederhana/posts/delete/{id}', 'PostController', 'delete');

// Home route
$router->add('GET', '/CMS_Sederhana', 'PostController', 'index');

return $router; 