<?php
require_once __DIR__ . '/../../core/Model.php';

class Post extends Model {
    public function getAllPosts() {
        $query = "SELECT p.*, c.name as category_name 
                 FROM posts p 
                 LEFT JOIN categories c ON p.category_id = c.id 
                 ORDER BY p.created_at DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getPostById($id) {
        $query = "SELECT p.*, c.name as category_name 
                 FROM posts p 
                 LEFT JOIN categories c ON p.category_id = c.id 
                 WHERE p.id = ?";
        return $this->db->query($query, [$id])->fetch();
    }

    public function createPost($title, $content, $category_id) {
        $query = "INSERT INTO posts (title, content, category_id, created_at) 
                 VALUES (?, ?, ?, NOW())";
        return $this->db->query($query, [$title, $content, $category_id]);
    }

    public function updatePost($id, $title, $content, $category_id) {
        $query = "UPDATE posts 
                 SET title = ?, content = ?, category_id = ?, updated_at = NOW() 
                 WHERE id = ?";
        return $this->db->query($query, [$title, $content, $category_id, $id]);
    }

    public function deletePost($id) {
        $query = "DELETE FROM posts WHERE id = ?";
        return $this->db->query($query, [$id]);
    }
} 