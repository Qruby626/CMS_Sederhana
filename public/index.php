<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Set APP_DEBUG for debugging purposes (temporary)
$_ENV['APP_DEBUG'] = true;

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Load configuration
require_once BASE_PATH . '/config/connection.php';
require_once BASE_PATH . '/app/controllers/CommentController.php';

// Debug information
echo "<!-- Debug: Base path is " . BASE_PATH . " -->\n";
echo "<!-- Debug: Current file is " . __FILE__ . " -->\n";

try {
    // Load router
    $router = require_once BASE_PATH . '/config/routes.php';
    
    // Debug information
    echo "<!-- Debug: Router loaded successfully -->\n";
    
    // Dispatch the request
    $router->dispatch();
} catch (Exception $e) {
    // Log the error
    error_log($e->getMessage());
    
    // Show error page
    header("HTTP/1.0 500 Internal Server Error");
    echo "<h1>500 Internal Server Error</h1>";
    echo "<p>An error occurred while processing your request.</p>";
    if (isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG']) {
        echo "<pre>" . $e->getMessage() . "</pre>";
    }
}
