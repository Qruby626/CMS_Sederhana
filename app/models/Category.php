<?php
require_once __DIR__ . '/../../core/Model.php';

class Category extends Model {
    public function getAllCategories() {
        $query = "SELECT * FROM categories ORDER BY name ASC";
        return $this->db->query($query)->fetchAll();
    }

    public function getCategoryById($id) {
        $query = "SELECT * FROM categories WHERE id = ?";
        return $this->db->query($query, [$id])->fetch();
    }

    public function createCategory($name) {
        $query = "INSERT INTO categories (name) VALUES (?)";
        return $this->db->query($query, [$name]);
    }

    public function updateCategory($id, $name) {
        $query = "UPDATE categories SET name = ? WHERE id = ?";
        return $this->db->query($query, [$name, $id]);
    }

    public function deleteCategory($id) {
        $query = "DELETE FROM categories WHERE id = ?";
        return $this->db->query($query, [$id]);
    }
} 