<?php
require_once __DIR__ . '/../core/Database.php';

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->conn;
    }

    // Ambil semua post
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC");
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
    }

    // Ambil satu post berdasarkan ID
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Tambah post baru
    public function create($title, $content, $image = null)
    {
        $stmt = $this->db->prepare("INSERT INTO posts (title, content, image, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $title, $content, $image);
        return $stmt->execute();
    }

    // Update post
    public function update($id, $title, $content, $image = null)
    {
        $stmt = $this->db->prepare("UPDATE posts SET title = ?, content = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $content, $image, $id);
        return $stmt->execute();
    }

    // Hapus post
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}