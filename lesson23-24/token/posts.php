<?php
require __DIR__ . '/db.php'; //Функции работы с БД
require __DIR__ . '/auth.php'; //аутентификация

$posts = getPosts();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Посты</title>
</head>
<body>
<?php if ($isAdmin):?>
Добро пожаловать Админ <a href="?action=logout">Выход</a><br>
<?php else:?>
<form action="?action=login" method="post">
    <input type="text" name="login">
    <input type="text" name="password">
    <input type="checkbox" name="save"> Запомнить?
    <input type="submit" value="Войти">
</form>
<?php endif;?>
<a href="/">Главная</a>
<a href="/posts.php">Посты</a><br>
<h2>Все посты</h2>
<?php foreach ($posts as $post): ?>
    <div id="<?=$post['id']?>">
        <h3>
            <a href="/?page=post&id=<?= $post['id'] ?>">
                <?= htmlspecialchars($post['title']) ?>
            </a>

            &nbsp;&nbsp;&nbsp;
            <a href="/?page=post-edit&action=edit&id=<?=$post['id']?>">[edit]</a>
            &nbsp;&nbsp;&nbsp;
            <a href="/?page=posts&action=delete&id=<?=$post['id']?>">[X]</a>
            <button data-id="<?=$post['id']?>" type="button" class="deleteBtn" style="width: 50px;height: 30px; cursor:pointer">[x]</button>
        </h3>
    </div>
<?php endforeach; ?>
</body>
</html>
