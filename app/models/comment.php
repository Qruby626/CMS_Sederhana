<?php
require_once __DIR__ . '/../core/Database.php';

class Comment
{
    private $db;
    public function __construct() {
        $this->db = (new Database())->conn;
    }
    public function getAll() {
        $result = $this->db->query("SELECT * FROM comments ORDER BY created_at DESC");
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        return $comments;
    }
    public function create($post_id, $content) {
        $stmt = $this->db->prepare("INSERT INTO comments (post_id, content, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $post_id, $content);
        return $stmt->execute();
    }
}
