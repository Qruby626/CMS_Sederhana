<?php
require_once 'includes/auth.php';
requireLogin();

include 'config/connection.php';
$result = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CMS Sederhana</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="logout.php" class="nav-link">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">CMS Sederhana</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>Dashboard</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <!-- /.sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark">Selamat Datang di CMS Sederhana</h1>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <h1 class="mb-4 text-center">Daftar Post</h1>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <div class="card mb-4 shadow-sm">
                <div class="card-body">
                  <?php if($row['image']): ?>
                      <img src="uploads/<?= $row['image'] ?>" class="img-thumbnail mb-2" width="120">
                  <?php endif; ?>
                  <h3 class="card-title"><?= htmlspecialchars($row['title']) ?></h3>
                  <p class="card-text"><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                  <div class="text-muted small">Diposting pada <?= date('d M Y H:i', strtotime($row['created_at'])) ?></div>
                </div>
              </div>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($result) == 0): ?>
              <div class="alert alert-info text-center">Belum ada post.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2025 CMS Sederhana.</strong>
  </footer>
</div>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
</body>
</html>
