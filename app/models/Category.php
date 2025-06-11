<?php
require_once __DIR__ . '/../../core/Model.php';

class Category extends Model {
    public function getAllCategories() {
        $query = "SELECT * FROM categories WHERE deleted_at IS NULL ORDER BY name ASC";
        return $this->db->query($query)->fetchAll();
    }

    public function getCategoryById($id) {
        $query = "SELECT * FROM categories WHERE id = ? AND deleted_at IS NULL";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createCategory($name) {
        $query = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$name]);
    }

    public function updateCategory($id, $name) {
        $query = "UPDATE categories SET name = ? WHERE id = ? AND deleted_at IS NULL";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$name, $id]);
    }

    public function deleteCategory($id) {
        $query = "UPDATE categories SET deleted_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
} 