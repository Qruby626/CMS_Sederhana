<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../core/Auth.php';

class DashboardController extends Controller {
    private $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function index() {
        // Memastikan pengguna sudah login sebelum menampilkan dashboard
        $this->auth->requireLogin();
        
        $data = [
            'user' => $this->auth->getCurrentUser()
        ];
        $this->render('dashboard', $data);
    }
}
