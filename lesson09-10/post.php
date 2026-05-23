<?php
require __DIR__ . '/functions/app.php';

try {
    $id = $_GET['id'] ?? null;

    //Валидация
    if (is_null($id)) {
        throw new OutOfBoundsException('ID поста не передан');
    }

    if (!is_numeric($id)) {
        throw new OutOfBoundsException('ID поста должен быть числом');
    }


    $post = getPost($id);


} catch (OutOfBoundsException $e) {

   // http_response_code(404);
   // $error = "404 пост не найден. " . $e->getMessage();

    //Редирект
    header("Location: 404.php?error=???");
    die();

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
<h2>Пост</h2>

<?php if (!isset($error)): ?>
    <div>
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <p><?= htmlspecialchars($post['content']) ?></p>
        <span><?= htmlspecialchars($post['date']) ?></span>
        <span><?= htmlspecialchars($post['author']) ?></span>
    </div>
<?php else: ?>
    <?= htmlspecialchars($error) ?>
<?php endif; ?>
</body>
</html>