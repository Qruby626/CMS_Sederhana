<?php
require_once __DIR__ . '/../../core/Model.php';

class User extends Model {
    public function findByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function createUser($username, $email, $password, $role = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$username, $email, $hashedPassword, $role]);
    }

    public function getAllUsers() {
        $query = "SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getUserById($id) {
        $query = "SELECT id, username, email, role, created_at FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateUser($id, $username, $email, $role) {
        $query = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$username, $email, $role, $id]);
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
} 