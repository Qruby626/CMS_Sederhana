<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php require_once __DIR__ . '/../../includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Search Results for "<?= htmlspecialchars($searchTerm) ?>"</h1>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="/CMS_Sederhana/posts/search" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search posts..." name="q" value="<?= htmlspecialchars($searchTerm) ?>">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <h2>Posts Found</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($posts)): ?>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td><?= htmlspecialchars($post['id']) ?></td>
                                    <td><?= htmlspecialchars($post['title']) ?></td>
                                    <td><?= htmlspecialchars($post['category_name'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($post['created_at']) ?></td>
                                    <td class="table-actions">
                                        <a href="/CMS_Sederhana/posts/edit/<?= $post['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="/CMS_Sederhana/posts/delete/<?= $post['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No posts found matching your search.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?> 