<?php
require_once __DIR__ . '/../core/Controller.php';

class CategoryController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $categoryModel = $this->model('Category');
        $categories = $categoryModel->getAll();
        $this->view('categories/index', ['categories' => $categories]);
    }

    // Tampilkan form tambah kategori
    public function create()
    {
        $this->view('categories/create');
    }

    // Proses tambah kategori
    public function store()
    {
        $categoryModel = $this->model('Category');
        $name = $_POST['name'] ?? '';
        $categoryModel->create($name);
        header('Location: /categories');
        exit;
    }

    // Tampilkan form edit kategori
    public function edit($id)
    {
        $categoryModel = $this->model('Category');
        $category = $categoryModel->getById($id);
        $this->view('categories/edit', ['category' => $category]);
    }

    // Proses update kategori
    public function update($id)
    {
        $categoryModel = $this->model('Category');
        $name = $_POST['name'] ?? '';
        $categoryModel->update($id, $name);
        header('Location: /categories');
        exit;
    }

    // Hapus kategori
    public function delete($id)
    {
        $categoryModel = $this->model('Category');
        $categoryModel->delete($id);
        header('Location: /categories');
        exit;
    }
}