<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../core/Auth.php';

class AuthController extends Controller {
    private $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function login() {
        if ($this->auth->isLoggedIn()) {
            $this->redirect('/CMS_Sederhana/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $remember = isset($_POST['remember']);

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Please fill in all fields';
                $this->redirect('/CMS_Sederhana/auth/login');
            }

            if ($this->auth->login($username, $password)) {
                if ($remember) {
                    // Set a cookie that expires in 30 days
                    setcookie('remember_user', $username, time() + (86400 * 30), '/');
                }
                $this->redirect('/CMS_Sederhana/dashboard');
            } else {
                $_SESSION['error'] = 'Invalid username or password';
                $this->redirect('/CMS_Sederhana/auth/login');
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        if ($this->auth->isLoggedIn()) {
            $this->redirect('/CMS_Sederhana/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';

            if ($this->auth->register($username, $password, $email)) {
                $_SESSION['success'] = 'Registration successful. Please login.';
                $this->redirect('/CMS_Sederhana/auth/login');
            } else {
                $_SESSION['error'] = 'Registration failed. Username or email might be taken.';
            }
        }

        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        $this->auth->logout();
        $this->redirect('/CMS_Sederhana/auth/login');
    }
} 