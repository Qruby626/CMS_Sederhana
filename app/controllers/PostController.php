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
            
            // Validate input if necessary, e.g., ensure required fields are not empty
            if (empty($title) || empty($content)) {
                $_SESSION['message'] = 'Title and Content cannot be empty.';
                $_SESSION['message_type'] = 'danger';
                header('Location: /CMS_Sederhana/posts/create'); // Redirect back to create form
                exit;
            }

            if ($this->postModel->createPost($title, $content, $category_id)) {
                $_SESSION['message'] = 'Post created successfully!';
                $_SESSION['message_type'] = 'success';
                header('Location: /CMS_Sederhana/posts'); // Corrected URL
                exit;
            } else {
                $_SESSION['message'] = 'Failed to create post.';
                $_SESSION['message_type'] = 'danger';
                header('Location: /CMS_Sederhana/posts/create'); // Redirect back to create form
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
            
            // Validate input if necessary
            if (empty($title) || empty($content)) {
                $_SESSION['message'] = 'Title and Content cannot be empty.';
                $_SESSION['message_type'] = 'danger';
                header('Location: /CMS_Sederhana/posts/edit/' . $id);
                exit;
            }

            if ($this->postModel->updatePost($id, $title, $content, $category_id)) {
                $_SESSION['message'] = 'Post updated successfully!';
                $_SESSION['message_type'] = 'success';
                header('Location: /CMS_Sederhana/posts'); // Corrected URL
                exit;
            } else {
                $_SESSION['message'] = 'Failed to update post.';
                $_SESSION['message_type'] = 'danger';
                header('Location: /CMS_Sederhana/posts/edit/' . $id);
                exit;
            }
        }
        $post = $this->postModel->getPostById($id);
        if (!$post) {
            $_SESSION['message'] = 'Post not found!';
            $_SESSION['message_type'] = 'danger';
            header('Location: /CMS_Sederhana/posts');
            exit;
        }
        $categories = $this->categoryModel->getAllCategories();
        require_once __DIR__ . '/../views/posts/edit.php';
    }

    public function delete($id) {
        if ($this->postModel->deletePost($id)) {
            $_SESSION['message'] = 'Post deleted successfully!';
            $_SESSION['message_type'] = 'success';
            header('Location: /CMS_Sederhana/posts'); // Corrected URL
            exit;
        } else {
            $_SESSION['message'] = 'Failed to delete post.';
            $_SESSION['message_type'] = 'danger';
            header('Location: /CMS_Sederhana/posts');
            exit;
        }
    }
} 