<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/MediaController.php';

$router = new Router();

// Auth routes
$router->add('GET', '/auth/login', 'AuthController', 'login');
$router->add('POST', '/auth/login', 'AuthController', 'login');
$router->add('GET', '/auth/register', 'AuthController', 'register');
$router->add('POST', '/auth/register', 'AuthController', 'register');
$router->add('GET', '/auth/logout', 'AuthController', 'logout');

// Dashboard route
$router->add('GET', '/dashboard', 'DashboardController', 'index');

// Admin route
$router->add('GET', '/admin', 'AdminController', 'index');

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
$router->add('GET', '/posts/view/{id}', 'PostController', 'view');

// Media routes
$router->add('GET', '/media', 'MediaController', 'index');
$router->add('POST', '/media/upload', 'MediaController', 'upload');
$router->add('GET', '/media/delete/{id}', 'MediaController', 'delete');
$router->add('GET', '/media/filepicker', 'MediaController', 'tinyMceFilePicker');
$router->add('POST', '/media/uploadtinymce', 'MediaController', 'tinyMceImageUpload');

// Search route
$router->add('GET', '/posts/search', 'PostController', 'search');

// Comment routes
$router->add('POST', '/comments/add', 'CommentController', 'add');
$router->add('GET', '/comments/delete/{id}', 'CommentController', 'delete');

// Home route
$router->add('GET', '/', 'PostController', 'index');

return $router; 