<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Category.php';

class CategoryController extends Controller {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        require_once __DIR__ . '/../views/categories/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            if ($this->categoryModel->createCategory($name)) {
                header('Location: /categories');
                exit;
            }
        }
        require_once __DIR__ . '/../views/categories/create.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            if ($this->categoryModel->updateCategory($id, $name)) {
                header('Location: /categories');
                exit;
            }
        }
        $category = $this->categoryModel->getCategoryById($id);
        require_once __DIR__ . '/../views/categories/edit.php';
    }

    public function delete($id) {
        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: /categories');
            exit;
        }
    }
} 