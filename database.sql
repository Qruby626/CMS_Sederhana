-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS cms_sederhana;
USE cms_sederhana;

-- Buat tabel users jika belum ada
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Hapus user admin jika sudah ada (untuk menghindari duplikasi)
DELETE FROM users WHERE username = 'admin';

-- Insert user admin baru
INSERT INTO users (username, password, email) 
VALUES ('adminbaru', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com'); 