<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>CMS System Check</h1>";

// Check Database Connection
echo "<h2>Database Connection Check</h2>";
try {
    require_once __DIR__ . '/../config/connection.php';
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<div style='color: green;'>✓ Database connection successful!</div>";
    
    // Test query
    $stmt = $pdo->query("SHOW TABLES");
    echo "<h3>Tables in database:</h3><ul>";
    while ($row = $stmt->fetch()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
} catch (PDOException $e) {
    echo "<div style='color: red;'>✗ Connection failed: " . $e->getMessage() . "</div>";
}

// Check File Structure
echo "<h2>File Structure Check</h2>";
$required_files = [
    'app/controllers/CategoryController.php',
    'app/controllers/PostController.php',
    'app/controllers/AuthController.php',
    'app/models/Category.php',
    'app/models/Post.php',
    'core/Controller.php',
    'core/Model.php',
    'core/Router.php',
    'core/Auth.php',
    'config/connection.php',
    'config/routes.php',
    '.htaccess',
    'public/.htaccess',
    'public/index.php'
];

echo "<h3>Required Files:</h3><ul>";
foreach ($required_files as $file) {
    if (file_exists(__DIR__ . '/../' . $file)) {
        echo "<li style='color: green;'>✓ " . $file . "</li>";
    } else {
        echo "<li style='color: red;'>✗ " . $file . " (missing)</li>";
    }
}
echo "</ul>";

// Check Folder Permissions
echo "<h2>Folder Permissions Check</h2>";
$folders = [
    'app',
    'app/controllers',
    'app/models',
    'app/views',
    'app/views/auth',
    'app/views/categories',
    'app/views/posts',
    'config',
    'core',
    'public',
    'public/assets',
    'public/assets/css',
    'public/assets/js',
    'public/assets/img',
    'uploads'
];

echo "<h3>Folder Permissions:</h3><ul>";
foreach ($folders as $folder) {
    $path = __DIR__ . '/../' . $folder;
    if (file_exists($path)) {
        $perms = fileperms($path);
        $perms = substr(sprintf('%o', $perms), -4);
        $readable = is_readable($path) ? "readable" : "not readable";
        $writable = is_writable($path) ? "writable" : "not writable";
        echo "<li>" . $folder . ": " . $perms . " (" . $readable . ", " . $writable . ")</li>";
    } else {
        echo "<li style='color: red;'>✗ " . $folder . " (missing)</li>";
    }
}
echo "</ul>";

// Check PHP Configuration
echo "<h2>PHP Configuration Check</h2>";
echo "<ul>";
echo "<li>PHP Version: " . phpversion() . "</li>";
echo "<li>mod_rewrite: " . (in_array('mod_rewrite', apache_get_modules()) ? "Enabled" : "Disabled") . "</li>";
echo "<li>PDO: " . (extension_loaded('pdo') ? "Enabled" : "Disabled") . "</li>";
echo "<li>PDO MySQL: " . (extension_loaded('pdo_mysql') ? "Enabled" : "Disabled") . "</li>";
echo "</ul>";

// Check .htaccess
echo "<h2>.htaccess Check</h2>";
$htaccess_root = file_exists(__DIR__ . '/../.htaccess');
$htaccess_public = file_exists(__DIR__ . '/.htaccess');

echo "<ul>";
echo "<li>Root .htaccess: " . ($htaccess_root ? "✓ Present" : "✗ Missing") . "</li>";
echo "<li>Public .htaccess: " . ($htaccess_public ? "✓ Present" : "✗ Missing") . "</li>";
echo "</ul>"; 