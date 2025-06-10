<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/CMS_Sederhana/admin">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/CMS_Sederhana/posts">
                    Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/CMS_Sederhana/categories">
                    Categories
                </a>
            </li>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link" href="/CMS_Sederhana/users">
                    Users
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav> 