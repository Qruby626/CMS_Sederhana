<?php
require_once __DIR__ . '/../core/Database.php';

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->conn;
    }

    // Ambil semua kategori
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM categories ORDER BY name ASC");
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;
    }

    // Ambil satu kategori berdasarkan ID
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Tambah kategori baru
    public function create($name)
    {
        $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    // Update kategori
    public function update($id, $name)
    {
        $stmt = $this->db->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        return $stmt->execute();
    }

    // Hapus kategori
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}