<?php
session_start();

// Load configuration
require_once __DIR__ . '/../config/connection.php';

// Load router
$router = require_once __DIR__ . '/../config/routes.php';

// Dispatch the request
$router->dispatch();
