<?php
include '../../config/connection.php';

// Notifikasi
$notif = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'add') $notif = "<script>toastr.success('Post berhasil ditambahkan!');</script>";
    if ($_GET['msg'] == 'edit') $notif = "<script>toastr.success('Post berhasil diupdate!');</script>";
    if ($_GET['msg'] == 'delete') $notif = "<script>toastr.success('Post berhasil dihapus!');</script>";
}

$result = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Post</title>
    <!-- Bootstrap, Font Awesome, AdminLTE, DataTables, Toastr, jQuery, Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body.dark-mode { background: #222; color: #eee; }
        .sidebar { min-height: 100vh; }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar">
        <a href="#" class="brand-link text-center">
            <span class="brand-text font-weight-light">CMS Sederhana</span>
        </a>
        <div class="sidebar">
            <nav>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php"><i class="fas fa-newspaper"></i> Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../categories/index.php"><i class="fas fa-list"></i> Kategori</a>
                    </li>
                </ul>
                <button id="dark-toggle" class="btn btn-dark mt-3"><i class="fas fa-moon"></i> Dark Mode</button>
            </nav>
        </div>
    </aside>
    <!-- Content -->
    <div class="content-wrapper" style="margin-left:250px;">
        <section class="content pt-4">
            <div class="container-fluid">
                <h2 class="mb-4">Daftar Post</h2>
                <a href="create.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Post</a>
                <?= $notif ?>
                <div class="row" id="post-list">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow">
                            <div class="card-body">
                                <?php if($row['image']): ?>
                                    <img src="../../uploads/<?= $row['image'] ?>" class="img-thumbnail mb-2" width="120">
                                <?php endif; ?>
                                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="card-text"><?= substr(strip_tags($row['content']),0,100) ?>...</p>
                                <p class="text-muted small mb-2"><i class="fas fa-calendar"></i> <?= date('d M Y H:i', strtotime($row['created_at'])) ?></p>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')"><i class="fas fa-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // Dark mode toggle
    document.getElementById('dark-toggle').onclick = function() {
        document.body.classList.toggle('dark-mode');
    };
</script>
</body>
</html>