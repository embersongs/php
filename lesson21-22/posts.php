<?php
require __DIR__ . '/auth.php'; //аутентификация

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
</body>
</html>
