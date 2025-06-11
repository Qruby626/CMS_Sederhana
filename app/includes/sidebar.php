<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/CMS_Sederhana/dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/CMS_Sederhana/posts">
                    <i class="fas fa-newspaper"></i> Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/CMS_Sederhana/categories">
                    <i class="fas fa-tags"></i> Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/CMS_Sederhana/media">
                    <i class="fas fa-images"></i> Media
                </a>
            </li>
            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link" href="/CMS_Sederhana/users">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav> 