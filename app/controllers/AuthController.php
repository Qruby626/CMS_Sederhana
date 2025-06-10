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
            $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->auth->login($username, $password)) {
                $this->redirect('/');
            } else {
                $_SESSION['error'] = 'Invalid username or password';
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        if ($this->auth->isLoggedIn()) {
            $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';

            if ($this->auth->register($username, $password, $email)) {
                $_SESSION['success'] = 'Registration successful. Please login.';
                $this->redirect('/login');
            } else {
                $_SESSION['error'] = 'Registration failed. Username or email might be taken.';
            }
        }

        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        $this->auth->logout();
        $this->redirect('/login');
    }
} 