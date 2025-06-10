<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Komentar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tambah Komentar</h1>
        <form method="post" action="/comments/create">
            <div class="mb-3">
                <label class="form-label">ID Post:</label>
                <input type="number" name="post_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Isi Komentar:</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="/comments" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
