<?php
require_once __DIR__ . '/../core/Controller.php';

class CommentsController extends Controller
{
    public function index() {
        $commentModel = $this->model('Comment');
        $comments = $commentModel->getAll();
        $this->view('comments/index', ['comments' => $comments]);
    }
    public function create() {
        $this->view('comments/create');
    }
    public function store() {
        $commentModel = $this->model('Comment');
        $post_id = $_POST['post_id'] ?? 0;
        $content = $_POST['content'] ?? '';
        $commentModel->create($post_id, $content);
        header('Location: /comments');
        exit;
    }
}
