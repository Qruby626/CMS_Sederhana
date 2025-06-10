<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Komentar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Komentar</h1>
        <a href="/comments/create" class="btn btn-primary mb-3">Tambah Komentar</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Post</th>
                    <th>Komentar</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?= $comment['id'] ?></td>
                    <td><?= $comment['post_id'] ?></td>
                    <td><?= htmlspecialchars($comment['content']) ?></td>
                    <td><?= $comment['created_at'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($comments)): ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada komentar.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
