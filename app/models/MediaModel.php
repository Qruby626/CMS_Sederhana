<?php

class MediaModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function addMedia($fileName, $filePath, $fileType, $fileSize, $uploadedBy) {
        $query = "INSERT INTO media (file_name, file_path, file_type, file_size, uploaded_by) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$fileName, $filePath, $fileType, $fileSize, $uploadedBy]);
    }

    public function getAllMedia() {
        $query = "SELECT m.*, u.username FROM media m LEFT JOIN users u ON m.uploaded_by = u.id ORDER BY m.created_at DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMediaById($id) {
        $query = "SELECT m.*, u.username FROM media m LEFT JOIN users u ON m.uploaded_by = u.id WHERE m.id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteMedia($id) {
        $query = "DELETE FROM media WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
} 