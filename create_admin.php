<?php
require_once 'config/database.php';

// Hapus user admin yang lama
$query = "DELETE FROM users WHERE username = 'admin'";
mysqli_query($conn, $query);

// Buat password baru
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user admin baru
$query = "INSERT INTO users (username, password, email) VALUES ('admin', '$hashed_password', 'admin@example.com')";
if (mysqli_query($conn, $query)) {
    echo "Admin user berhasil dibuat!<br>";
    echo "Username: admin<br>";
    echo "Password: admin123<br>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?> 