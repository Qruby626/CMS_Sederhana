<?php
include '../../config/connection.php';

// Notifikasi
$notif = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'add') $notif = '<div class="alert alert-success">Post berhasil ditambahkan!</div>';
    if ($_GET['msg'] == 'edit') $notif = '<div class="alert alert-success">Post berhasil diupdate!</div>';
    if ($_GET['msg'] == 'delete') $notif = '<div class="alert alert-success">Post berhasil dihapus!</div>';
}

// Pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$where = $search ? "WHERE title LIKE '%$search%'" : '';
$result = mysqli_query($conn, "SELECT * FROM posts $where ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2 class="mb-4">Daftar Post</h2>
    <?= $notif ?>
    <form class="row mb-3" method="get">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="col-md-2">
            <button class="btn btn-info" type="submit">Cari</button>
            <a href="index.php" class="btn btn-secondary">Reset</a>
        </div>
        <div class="col-md-6 text-end">
            <a href="create.php" class="btn btn-primary">Tambah Post</a>
        </div>
    </form>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Judul</th>
                <th>Konten</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['content'])) ?></td>
                <td><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>