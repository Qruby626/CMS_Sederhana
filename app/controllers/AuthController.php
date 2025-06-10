<?php
require_once __DIR__ . '/../core/Controller.php';

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // Method untuk menampilkan halaman login
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (isset($_SESSION['user_id'])) {
            header("Location: /dashboard");
            exit();
        }

        // Jika form login di-submit
        if (isset($_POST['login'])) {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            
            if (empty($username) || empty($password)) {
                $error = "Username dan password harus diisi!";
            } else {
                $query = "SELECT * FROM users WHERE username = ?";
                $stmt = $this->db->conn->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows == 1) {
                    $user = $result->fetch_assoc();
                    
                    if (password_verify($password, $user['password'])) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['flash_message'] = "Selamat datang, " . $user['username'] . "!";
                        header("Location: /dashboard");
                        exit();
                    }
                }
                $error = "Username atau password salah!";
            }
        }

        // Tampilkan view login
        $this->view('auth/login', [
            'error' => $error ?? null,
            'username' => $username ?? ''
        ]);
    }

    // Method untuk proses logout
    public function logout()
    {
        session_start();
        session_destroy();
        $_SESSION['flash_message'] = "Anda telah berhasil logout.";
        header("Location: /login");
        exit();
    }

    // Method untuk membuat admin baru
    public function createAdmin()
    {
        // Cek apakah user sudah login dan adalah admin
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            
            if (empty($username) || empty($password)) {
                $error = "Username dan password harus diisi!";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                $query = "INSERT INTO users (username, password) VALUES (?, ?)";
                $stmt = $this->db->conn->prepare($query);
                $stmt->bind_param("ss", $username, $hashedPassword);
                
                if ($stmt->execute()) {
                    $_SESSION['flash_message'] = "Admin berhasil dibuat!";
                    header("Location: /dashboard");
                    exit();
                } else {
                    $error = "Error: " . $stmt->error;
                }
            }
        }

        $this->view('auth/create_admin', [
            'error' => $error ?? null,
            'username' => $username ?? ''
        ]);
    }
}