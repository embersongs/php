<?php
$postsJson = file_get_contents(__DIR__ . '/data/posts.json');
$posts = json_decode($postsJson, true, JSON_THROW_ON_ERROR);

$id = $_GET['id'] ?? null;
$post = $posts[$id] ?? null;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<a href="/">Главная</a>
<a href="/posts.php">Посты</a><br>
<h2>Пост</h2>

<?php if (!is_null($post)): ?>
    <div>
        <h3><?=$post['title']?></h3>
        <p><?=$post['date']?></p>
        <p><?=$post['author']?></p>
    </div>
<?php else:?>
    Нет такого поста, 404 error
<?php endif;?>
</body>
</html>