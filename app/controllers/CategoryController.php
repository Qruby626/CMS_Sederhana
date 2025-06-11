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
                $_SESSION['message'] = 'Category created successfully!';
                $_SESSION['message_type'] = 'success';
                header('Location: /CMS_Sederhana/categories');
                exit;
            } else {
                $_SESSION['message'] = 'Failed to create category.';
                $_SESSION['message_type'] = 'danger';
                header('Location: /CMS_Sederhana/categories/create');
                exit;
            }
        }
        require_once __DIR__ . '/../views/categories/create.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            if ($this->categoryModel->updateCategory($id, $name)) {
                $_SESSION['message'] = 'Category updated successfully!';
                $_SESSION['message_type'] = 'success';
                header('Location: /CMS_Sederhana/categories');
                exit;
            } else {
                $_SESSION['message'] = 'Failed to update category.';
                $_SESSION['message_type'] = 'danger';
                header('Location: /CMS_Sederhana/categories/edit/' . $id);
                exit;
            }
        }
        
        $category = $this->categoryModel->getCategoryById($id);

        if (!$category) {
            $_SESSION['message'] = 'Category not found!';
            $_SESSION['message_type'] = 'danger';
            header('Location: /CMS_Sederhana/categories');
            exit;
        }

        require_once __DIR__ . '/../views/categories/edit.php';
    }

    public function delete($id) {
        if ($this->categoryModel->deleteCategory($id)) {
            $_SESSION['message'] = 'Category deleted successfully!';
            $_SESSION['message_type'] = 'success';
            header('Location: /CMS_Sederhana/categories');
            exit;
        } else {
            $_SESSION['message'] = 'Failed to delete category.';
            $_SESSION['message_type'] = 'danger';
            header('Location: /CMS_Sederhana/categories'); // Redirect back to categories list
            exit;
        }
    }
} 