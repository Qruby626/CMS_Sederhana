<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'CMS Sederhana' ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/adminlte.min.css">
    <style>
        /* Custom styles for main layout */
        .main-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-bottom: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .main-header .navbar-light .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .main-header .navbar-light .navbar-nav .nav-link:hover {
            color: #fff;
            transform: translateY(-1px);
        }
        .main-sidebar {
            background: #2c3e50;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .nav-sidebar .nav-item .nav-link {
            border-radius: 8px;
            margin: 4px 8px;
            transition: all 0.3s ease;
        }
        .nav-sidebar .nav-item .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        .brand-link {
            border-bottom: none;
            padding: 1.5rem 1rem;
            background: rgba(255, 255, 255, 0.05);
        }
        .brand-text {
            font-weight: 600;
            font-size: 1.2rem;
            color: #fff;
        }
        .content-wrapper {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: none;
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="hold-transition <?= $bodyClass ?? 'sidebar-mini' ?>">
    <div class="wrapper">
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="/dashboard" class="brand-link">
                    <span class="brand-text font-weight-light">CMS Sederhana</span>
                </a>
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/posts" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Posts</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/categories" class="nav-link">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
        <?php endif; ?>

        <!-- Content -->
        <div class="content-wrapper">
            <?php if (isset($_SESSION['flash_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['flash_message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['flash_message']); ?>
            <?php endif; ?>

            <?= $content ?? '' ?>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y') ?> CMS Sederhana.</strong>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/adminlte.min.js"></script>
</body>
</html>
