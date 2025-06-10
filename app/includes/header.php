<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/CMS_Sederhana/public/assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="/CMS_Sederhana">Home</a>
            <a href="/CMS_Sederhana/posts">Posts</a>
            <a href="/CMS_Sederhana/categories">Categories</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/CMS_Sederhana/logout">Logout</a>
            <?php else: ?>
                <a href="/CMS_Sederhana/login">Login</a>
                <a href="/CMS_Sederhana/register">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <main> 