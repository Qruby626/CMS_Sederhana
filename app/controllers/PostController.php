<?php
require_once __DIR__ . '/../core/Controller.php';

class PostController extends Controller
{
    private $uploadPath;
    private $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    private $maxFileSize = 5242880; // 5MB

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = __DIR__ . '/../../public/img/';
        
        // Buat folder upload jika belum ada
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
        }
    }

    // Tampilkan semua post
    public function index()
    {
        $postModel = $this->model('Post');
        $posts = $postModel->getAll();
        $this->view('posts/index', ['posts' => $posts]);
    }

    // Tampilkan form tambah post
    public function create()
    {
        $this->view('posts/create');
    }

    // Proses tambah post
    public function store()
    {
        $postModel = $this->model('Post');
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $image = null;

        // Upload image jika ada
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $this->handleImageUpload($_FILES['image']);
            if (!$image) {
                $_SESSION['error'] = "Gagal upload gambar. Pastikan file adalah gambar (JPG, PNG, GIF) dan ukuran maksimal 5MB.";
                header('Location: /posts/create');
                exit;
            }
        }

        $postModel->create($title, $content, $image);
        $_SESSION['success'] = "Post berhasil ditambahkan!";
        header('Location: /posts');
        exit;
    }

    // Tampilkan form edit post
    public function edit($id)
    {
        $postModel = $this->model('Post');
        $post = $postModel->getById($id);
        $this->view('posts/edit', ['post' => $post]);
    }

    // Proses update post
    public function update($id)
    {
        $postModel = $this->model('Post');
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $image = null;

        // Upload image jika ada
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $this->handleImageUpload($_FILES['image']);
            if (!$image) {
                $_SESSION['error'] = "Gagal upload gambar. Pastikan file adalah gambar (JPG, PNG, GIF) dan ukuran maksimal 5MB.";
                header('Location: /posts/edit/' . $id);
                exit;
            }
        }

        $postModel->update($id, $title, $content, $image);
        $_SESSION['success'] = "Post berhasil diupdate!";
        header('Location: /posts');
        exit;
    }

    // Hapus post
    public function delete($id)
    {
        $postModel = $this->model('Post');
        $post = $postModel->getById($id);
        
        // Hapus file gambar jika ada
        if ($post['image']) {
            $imagePath = $this->uploadPath . $post['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $postModel->delete($id);
        $_SESSION['success'] = "Post berhasil dihapus!";
        header('Location: /posts');
        exit;
    }

    // Handle upload gambar
    private function handleImageUpload($file)
    {
        // Validasi tipe file
        if (!in_array($file['type'], $this->allowedTypes)) {
            return false;
        }

        // Validasi ukuran file
        if ($file['size'] > $this->maxFileSize) {
            return false;
        }

        // Generate nama file unik
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $target = $this->uploadPath . $filename;

        // Upload file
        if (move_uploaded_file($file['tmp_name'], $target)) {
            return $filename;
        }

        return false;
    }
}