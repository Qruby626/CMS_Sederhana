<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

echo "<h2>Folder Permissions Check</h2>";

foreach ($folders as $folder) {
    if (file_exists($folder)) {
        $perms = fileperms($folder);
        $perms = substr(sprintf('%o', $perms), -4);
        echo "$folder: $perms (";
        echo is_readable($folder) ? "readable" : "not readable";
        echo ", ";
        echo is_writable($folder) ? "writable" : "not writable";
        echo ")<br>";
    } else {
        echo "$folder: does not exist<br>";
    }
}

echo "<h2>File Permissions Check</h2>";

$files = [
    '.htaccess',
    'public/.htaccess',
    'public/index.php',
    'config/connection.php',
    'config/routes.php',
    'core/Router.php',
    'core/Controller.php',
    'core/Model.php',
    'core/Auth.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $perms = fileperms($file);
        $perms = substr(sprintf('%o', $perms), -4);
        echo "$file: $perms (";
        echo is_readable($file) ? "readable" : "not readable";
        echo ", ";
        echo is_writable($file) ? "writable" : "not writable";
        echo ")<br>";
    } else {
        echo "$file: does not exist<br>";
    }
} 