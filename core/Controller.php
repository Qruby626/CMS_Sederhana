<?php
class Controller {
    protected function render($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../app/views/{$view}.php";
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function getPost($key, $default = null) {
        return $_POST[$key] ?? $default;
    }

    protected function getQuery($key, $default = null) {
        return $_GET[$key] ?? $default;
    }
} 