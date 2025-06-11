<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../models/MediaModel.php';

class MediaController extends Controller {
    private $mediaModel;
    private $auth;

    public function __construct() {
        $this->mediaModel = new MediaModel();
        $this->auth = new Auth();
    }

    public function index() {
        $this->auth->requireLogin();
        // You might want to add a role check here if only admins can manage media
        // if (!$this->auth->hasRole('admin')) {
        //     $this->redirect('/CMS_Sederhana/dashboard');
        // }

        $media = $this->mediaModel->getAllMedia();
        $data = [
            'media' => $media,
            'page_title' => 'Media Library'
        ];
        $this->render('media/index', $data);
    }

    public function upload() {
        $this->auth->requireLogin();
        // if (!$this->auth->hasRole('admin')) {
        //     $this->redirect('/CMS_Sederhana/dashboard');
        // }

        if ($this->isPost() && isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $uploadDir = BASE_PATH . '/public/uploads/';

            // Ensure the uploads directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = basename($file['name']);
            $filePath = $uploadDir . $fileName;
            $fileType = $file['type'];
            $fileSize = $file['size'];
            $uploadedBy = $_SESSION['user_id'] ?? null;

            // Basic validation
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['error'] = 'File upload error: ' . $file['error'];
            } elseif (!in_array($fileType, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                $_SESSION['error'] = 'Invalid file type. Only images are allowed.';
            } elseif ($fileSize > 5 * 1024 * 1024) { // 5MB limit
                $_SESSION['error'] = 'File size exceeds 5MB limit.';
            } elseif (file_exists($filePath)) {
                $_SESSION['error'] = 'File with the same name already exists.';
            } else {
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $relativeFilePath = '/CMS_Sederhana/public/uploads/' . $fileName;
                    if ($this->mediaModel->addMedia($fileName, $relativeFilePath, $fileType, $fileSize, $uploadedBy)) {
                        $_SESSION['message'] = 'File uploaded successfully.';
                    } else {
                        $_SESSION['error'] = 'Failed to save media info to database.';
                        // Remove uploaded file if database entry fails
                        unlink($filePath);
                    }
                } else {
                    $_SESSION['error'] = 'Failed to move uploaded file.';
                }
            }
            $this->redirect('/CMS_Sederhana/media'); // Redirect back to media library
        }
    }

    public function delete($id) {
        $this->auth->requireLogin();
        // if (!$this->auth->hasRole('admin')) {
        //     $this->redirect('/CMS_Sederhana/dashboard');
        // }

        $mediaItem = $this->mediaModel->getMediaById($id);
        if ($mediaItem) {
            $absoluteFilePath = BASE_PATH . $mediaItem['file_path'];
            if (file_exists($absoluteFilePath) && unlink($absoluteFilePath)) {
                if ($this->mediaModel->deleteMedia($id)) {
                    $_SESSION['message'] = 'Media deleted successfully.';
                } else {
                    $_SESSION['error'] = 'Failed to delete media info from database.';
                }
            } else {
                $_SESSION['error'] = 'Failed to delete file from server or file not found.';
                // Still try to delete from DB if file not found but record exists
                $this->mediaModel->deleteMedia($id);
            }
        } else {
            $_SESSION['error'] = 'Media not found.';
        }
        $this->redirect('/CMS_Sederhana/media');
    }

    // This method will be called by TinyMCE's file_picker_callback
    public function tinyMceFilePicker() {
        $this->auth->requireLogin();
        // You might want to add a role check here as well

        $media = $this->mediaModel->getAllMedia();

        // Prepare data in a format TinyMCE expects
        $jsonResponse = [];
        foreach ($media as $item) {
            if (strpos($item['file_type'], 'image/') === 0) { // Only show images for now
                $jsonResponse[] = [
                    'title' => htmlspecialchars($item['file_name']),
                    'value' => $item['file_path'] // Use the relative path for TinyMCE
                ];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($jsonResponse);
        exit;
    }

    // Method to handle TinyMCE image upload
    public function tinyMceImageUpload() {
        $this->auth->requireLogin();
        // if (!$this->auth->hasRole('admin')) {
        //     header('HTTP/1.0 403 Forbidden');
        //     echo json_encode(['error' => 'Forbidden']);
        //     exit;
        // }

        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $uploadDir = BASE_PATH . '/public/uploads/';
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = uniqid() . '_' . basename($file['name']); // Use unique ID for file name
            $filePath = $uploadDir . $fileName;
            $fileType = $file['type'];
            $fileSize = $file['size'];
            $uploadedBy = $_SESSION['user_id'] ?? null;

            if ($file['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['error' => 'File upload error: ' . $file['error']]);
            } elseif (!in_array($fileType, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                echo json_encode(['error' => 'Invalid file type. Only images are allowed.']);
            } elseif ($fileSize > 5 * 1024 * 1024) { // 5MB limit
                echo json_encode(['error' => 'File size exceeds 5MB limit.']);
            } else {
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $relativeFilePath = '/CMS_Sederhana/public/uploads/' . $fileName;
                    if ($this->mediaModel->addMedia($fileName, $relativeFilePath, $fileType, $fileSize, $uploadedBy)) {
                        header('Content-Type: application/json');
                        echo json_encode(['location' => $relativeFilePath]);
                    } else {
                        unlink($filePath); // Remove uploaded file if database entry fails
                        echo json_encode(['error' => 'Failed to save media info to database.']);
                    }
                } else {
                    echo json_encode(['error' => 'Failed to move uploaded file.']);
                }
            }
        } else {
            echo json_encode(['error' => 'No file uploaded.']);
        }
        exit;
    }
} 