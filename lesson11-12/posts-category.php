<?php

require __DIR__ . '/functions/app.php';

$slug = $_GET['category'] ?? null;

try {
    if (is_null($slug)) {
        throw new OutOfBoundsException('Slug категории не передан');
    }

/*    if (!is_numeric($id)) {
        throw new Exception('ID категории должен быть числом');
    }*/


   // $category = getCategoryById($id);
    //$posts = getPostsCategoriesById($id);

    $category = getCategoryBySlug($slug);
    $posts = getPostsCategoriesBySlug($slug);


} catch (OutOfBoundsException $e) {

    http_response_code(404);
    $error = "404 категория не найдена. " . $e->getMessage();

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
<h2>Посты категории <?= htmlspecialchars($category['name'] ?? '') ?></h2>
<?php if (!isset($error)): ?>
    <?php foreach ($posts as $post): ?>
        <div>
            <h3>
                <a href="/post.php?id=<?= htmlspecialchars($post['id']) ?>">
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