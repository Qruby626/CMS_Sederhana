<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'cms_db');
define('DB_USER', 'root');
define('DB_PASS', '');

$conn = mysqli_connect("localhost", "root", "", "cms_sederhana");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>  