<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../core/Auth.php';

class AdminController extends Controller {
    private $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function index() {
        // Memastikan pengguna sudah login
        $this->auth->requireLogin();
        
        // Anda bisa menambahkan logika pengecekan role di sini jika diperlukan
        // if (!$this->auth->hasRole('admin')) {
        //     $this->redirect('/CMS_Sederhana/dashboard'); // Atau halaman error unauthorized
        // }

        $data = [
            'user' => $this->auth->getCurrentUser(),
            'page_title' => 'Admin Panel'
        ];
        $this->render('admin/index', $data);
    }
}
