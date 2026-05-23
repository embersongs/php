<?php
$postsJson = file_get_contents(__DIR__ . '/data/posts.json');
$posts = json_decode($postsJson, true, JSON_THROW_ON_ERROR);

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
<h2>Посты</h2>
<?php foreach ($posts as $post): ?>
    <div>
        <h3><a href="/post.php?id=<?=$post['id']?>"><?=$post['title']?></a></h3>
        <p><?=$post['date']?></p>
        <p><?=$post['author']?></p>
    </div>
<?php endforeach; ?>
</body>
</html>