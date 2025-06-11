<?php
require_once __DIR__ . '/../../core/Model.php';

class Comment extends Model {
    public function addComment($postId, $userId, $content) {
        $query = "INSERT INTO comments (post_id, user_id, content, created_at) 
                 VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$postId, $userId, $content]);
    }

    public function getCommentsByPostId($postId) {
        $query = "SELECT c.*, u.username 
                 FROM comments c 
                 JOIN users u ON c.user_id = u.id 
                 WHERE c.post_id = ? AND c.deleted_at IS NULL 
                 ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }

    public function deleteComment($id) {
        $query = "UPDATE comments SET deleted_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
} 