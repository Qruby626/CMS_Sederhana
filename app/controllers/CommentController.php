<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Comment.php';

class CommentController extends Controller {
    private $commentModel;

    public function __construct() {
        $this->commentModel = new Comment();
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postId = $_POST['post_id'] ?? '';
            $content = $_POST['content'] ?? '';
            $userId = $_SESSION['user_id'] ?? null;

            if (empty($content) || !$userId) {
                $_SESSION['message'] = 'Comment cannot be empty and you must be logged in.';
                $_SESSION['message_type'] = 'danger';
                header('Location: /CMS_Sederhana/posts/view/' . $postId);
                exit;
            }

            if ($this->commentModel->addComment($postId, $userId, $content)) {
                $_SESSION['message'] = 'Comment added successfully!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Failed to add comment.';
                $_SESSION['message_type'] = 'danger';
            }
            header('Location: /CMS_Sederhana/posts/view/' . $postId);
            exit;
        }
    }

    public function delete($id) {
        $comment = $this->commentModel->getCommentById($id);
        if (!$comment) {
            $_SESSION['message'] = 'Comment not found!';
            $_SESSION['message_type'] = 'danger';
            header('Location: /CMS_Sederhana/posts');
            exit;
        }

        // Check if user is the comment owner or an admin
        if ($_SESSION['user_id'] != $comment['user_id'] && !isset($_SESSION['is_admin'])) {
            $_SESSION['message'] = 'You are not authorized to delete this comment.';
            $_SESSION['message_type'] = 'danger';
            header('Location: /CMS_Sederhana/posts/view/' . $comment['post_id']);
            exit;
        }

        if ($this->commentModel->deleteComment($id)) {
            $_SESSION['message'] = 'Comment deleted successfully!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Failed to delete comment.';
            $_SESSION['message_type'] = 'danger';
        }
        header('Location: /CMS_Sederhana/posts/view/' . $comment['post_id']);
        exit;
    }
}