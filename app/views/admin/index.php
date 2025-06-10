<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Admin') ?> - CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/CMS_Sederhana/public/assets/css/style.css">
</head>
<body>
    <?php require_once __DIR__ . '/../includes/header.php'; ?>

    <main class="container">
        <h1><?= htmlspecialchars($page_title ?? 'Admin Panel') ?></h1>
        <p>Selamat datang di halaman admin, <?= htmlspecialchars($user['username'] ?? 'Pengguna') ?>!</p>
        <p>Di sini Anda dapat mengelola semua aspek CMS Anda.</p>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Postingan</h5>
                        <p class="card-text">Tambah, edit, atau hapus postingan.</p>
                        <a href="/CMS_Sederhana/posts" class="btn btn-primary">Lihat Postingan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Kategori</h5>
                        <p class="card-text">Buat, modifikasi, atau hapus kategori.</p>
                        <a href="/CMS_Sederhana/categories" class="btn btn-primary">Lihat Kategori</a>
                    </div>
                </div>
            </div>
            <!-- Anda bisa menambahkan lebih banyak kartu untuk fitur admin lainnya -->
        </div>
    </main>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html> 