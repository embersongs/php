<?php
require __DIR__ . '/functions/app.php';

try {

    $posts = getPosts();

} catch (Exception $e) {

    http_response_code(500);
    $error = "Ошибка сервера: " . $e->getMessage();

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include __DIR__ . '/components/menu.php' ?>
<h2>Посты</h2>
<?php if (!isset($error)): ?>
    <?php foreach ($posts as $post): ?>
        <div>
            <h3>
                <a href="/post.php?id=<?= $post['id'] ?>">
                    <?= htmlspecialchars($post['title']) ?>
                </a>
            </h3>
            <p><?= htmlspecialchars($post['date']) ?></p>
            <p><?= htmlspecialchars($post['author']) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <?= htmlspecialchars($error) ?>
<?php endif; ?>
</body>
</html>