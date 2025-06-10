<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Category.php';

class PostController extends Controller {
    private $postModel;
    private $categoryModel;

    public function __construct() {
        $this->postModel = new Post();
        $this->categoryModel = new Category();
    }

    public function index() {
        $posts = $this->postModel->getAllPosts();
        require_once __DIR__ . '/../views/posts/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            
            if ($this->postModel->createPost($title, $content, $category_id)) {
                header('Location: /posts');
                exit;
            }
        }
        $categories = $this->categoryModel->getAllCategories();
        require_once __DIR__ . '/../views/posts/create.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            
            if ($this->postModel->updatePost($id, $title, $content, $category_id)) {
                header('Location: /posts');
                exit;
            }
        }
        $post = $this->postModel->getPostById($id);
        $categories = $this->categoryModel->getAllCategories();
        require_once __DIR__ . '/../views/posts/edit.php';
    }

    public function delete($id) {
        if ($this->postModel->deletePost($id)) {
            header('Location: /posts');
            exit;
        }
    }
} 