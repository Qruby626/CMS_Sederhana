<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <span class="brand-text font-weight-light">CMS Sederhana</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="/CMS_Sederhana/index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Posts -->
                <li class="nav-item">
                    <a href="/CMS_Sederhana/admin/posts/index.php" class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'posts') !== false ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Post</p>
                    </a>
                </li>

                <!-- Kategori -->
                <li class="nav-item">
                    <a href="/CMS_Sederhana/admin/categories/index.php" class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'categories') !== false ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Kategori</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="/CMS_Sederhana/logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
