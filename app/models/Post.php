<?php
require_once __DIR__ . '/../../core/Model.php';

class Post extends Model {
    public function getAllPosts() {
        $query = "SELECT p.*, c.name as category_name 
                 FROM posts p 
                 LEFT JOIN categories c ON p.category_id = c.id 
                 WHERE p.deleted_at IS NULL ORDER BY p.created_at DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getPostById($id) {
        $query = "SELECT p.*, c.name as category_name 
                 FROM posts p 
                 LEFT JOIN categories c ON p.category_id = c.id 
                 WHERE p.id = ? AND p.deleted_at IS NULL";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createPost($title, $content, $category_id) {
        $query = "INSERT INTO posts (title, content, category_id, created_at) 
                 VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$title, $content, $category_id]);
    }

    public function updatePost($id, $title, $content, $category_id) {
        $query = "UPDATE posts 
                 SET title = ?, content = ?, category_id = ?, updated_at = NOW() 
                 WHERE id = ? AND deleted_at IS NULL";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$title, $content, $category_id, $id]);
    }

    public function deletePost($id) {
        $query = "UPDATE posts SET deleted_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
} 