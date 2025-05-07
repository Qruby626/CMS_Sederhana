<?php
include '../../config/connection.php';
$notif = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    if (mysqli_query($conn, "INSERT INTO posts (title, content) VALUES ('$title', '$content')")) {
        header('Location: index.php?msg=add');
        exit;
    } else {
        $notif = '<div class="alert alert-danger">Gagal menambah post!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Post</h4>
                </div>
                <div class="card-body">
                    <?= $notif ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Judul:</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konten:</label>
                            <textarea name="content" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>