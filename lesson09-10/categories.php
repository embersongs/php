<?php

require __DIR__ . '/functions/app.php';

try {

    $categories = getCategories();

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
<?php if (isset($categories)): ?>
    <?php foreach ($categories as $category): ?>
        <a href="/posts-category.php?category=<?= htmlspecialchars($category['slug']) ?>">
            <?= htmlspecialchars($category['name']) ?><br>
        </a>
    <?php endforeach; ?>
<?php else: ?>
    <?= htmlspecialchars($error) ?>
<?php endif; ?>

</body>
</html>