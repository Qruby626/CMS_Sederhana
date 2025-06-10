<?php
require_once __DIR__ . '/../core/Controller.php';

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cek apakah user sudah login - Dihapus karena sudah ditangani oleh AuthMiddleware
        // if (!isset($_SESSION['user_id'])) {
        //     header("Location: /login");
        //     exit();
        // }
    }

    public function index()
    {
        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'content' => 'Selamat datang di Dashboard CMS Sederhana'
        ]);
    }
}
