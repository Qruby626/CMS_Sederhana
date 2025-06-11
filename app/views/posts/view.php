<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php require_once __DIR__ . '/../../includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?= htmlspecialchars($post['title']) ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="/CMS_Sederhana/posts" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Posts
                    </a>
                </div>
            </div>

            <!-- Post Content -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="badge bg-primary me-2">
                                <i class="fas fa-folder me-1"></i> <?= htmlspecialchars($post['category_name'] ?? 'Uncategorized') ?>
                            </span>
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i> <?= date('F j, Y g:i a', strtotime($post['created_at'])) ?>
                            </small>
                        </div>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div>
                                <a href="/CMS_Sederhana/posts/edit/<?= $post['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <a href="/CMS_Sederhana/posts/delete/<?= $post['id'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this post?');">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="post-content">
                        <?= nl2br($post['content']) ?>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="comments-section">
                <h3 class="mb-4">Comments</h3>
                
                <!-- Comment Form -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Add a Comment</h5>
                            <form action="/CMS_Sederhana/comments/add" method="POST">
                                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                <div class="mb-3">
                                    <textarea class="form-control" name="content" rows="3" required placeholder="Write your comment here..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-1"></i> Submit Comment
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        Please <a href="/CMS_Sederhana/auth/login">login</a> to leave a comment.
                    </div>
                <?php endif; ?>

                <!-- Comments List -->
                <div class="comments-list">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            <i class="fas fa-user me-1"></i> <?= htmlspecialchars($comment['username']) ?>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i> <?= date('F j, Y g:i a', strtotime($comment['created_at'])) ?>
                                        </small>
                                    </div>
                                    <p class="card-text"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                                    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $comment['user_id'] || isset($_SESSION['is_admin']))): ?>
                                        <div class="text-end">
                                            <a href="/CMS_Sederhana/comments/delete/<?= $comment['id'] ?>" 
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Are you sure you want to delete this comment?');">
                                                <i class="fas fa-trash me-1"></i> Delete
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            No comments yet. Be the first to comment!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?> 