<?php
require_once __DIR__ . '/../core/Controller.php';

class PostController extends Controller
{
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
        $image = $_FILES['image']['name'] ?? null;

        // Upload image jika ada
        if ($image) {
            $target = __DIR__ . '/../../Public/img/' . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        }

        $postModel->create($title, $content, $image);
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
        $image = $_FILES['image']['name'] ?? null;

        // Upload image jika ada
        if ($image) {
            $target = __DIR__ . '/../../Public/img/' . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        }

        $postModel->update($id, $title, $content, $image);
        header('Location: /posts');
        exit;
    }

    // Hapus post
    public function delete($id)
    {
        $postModel = $this->model('Post');
        $postModel->delete($id);
        header('Location: /posts');
        exit;
    }
}