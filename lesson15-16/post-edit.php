<?php
require __DIR__ . '/vendor/autoload.php';

use function CompanyName\Blog\getCategories;
use function CompanyName\Blog\getPost;
use function CompanyName\Blog\getPosts;


$categories = getCategories();
$category_id = null;
$post = [];

//C - Edit
if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    //показать форму и вывести на ней данные поста для правки
    $id = (int)$_GET['id'];
    $post = getPost($id);
}

if (isset($_GET['action']) && $_GET['action'] === 'save') {
    //принять новые исправленные данные поста и сохранить его
    $id = htmlspecialchars($_POST['id'] ?? '');
    $title = htmlspecialchars($_POST['title'] ?? '');
    $content = htmlspecialchars($_POST['content'] ?? '');
    $category_id =  (int)($_POST['category_id'] ?? null);

    //Валидация
    if (empty($title)) {
        $errors['title'] = 'Заполните поле title';
    }

    if (empty($content)) {
        $errors['content'] = 'Заполните поле text';
    }

    if (empty($errors)) {
        $posts = getPosts();
        $posts[$id] = [
            'id' => $id,
            'category_id' => $category_id,
            'title' => $title,
            'content' => $content,
            'date' => $posts[$id]['date'],
            'author' => $posts[$id]['author']
        ];

        file_put_contents(__DIR__ . '/data/posts.json', json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        header("Location: /post.php?id=$id&success=edit");
        die();
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include __DIR__ . '/components/menu.php' ?>
<h2>Править пост пост</h2>
<form action="/post-edit.php?action=save" method="post" enctype="application/x-www-form-urlencoded">
    <input type="text" name="id" readonly hidden value="<?= $post['id'] ?? '' ?>">
    Категория:<br>
    <select name="category_id">
        <?php foreach ($categories as $category): ?>
            <option <?= ($category['id'] == ($post['category_id'] ?? $category_id)) ? 'selected' : '' ?>
                value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php endforeach; ?>
    </select><br>

    Заголовок поста:<br>
    <input type="text" name="title" value="<?= $post['title'] ?? $title ?? '' ?>">
    <?php if (!empty($errors['title'])): ?>
        <p style="color:red"><?= $errors['title'] ?></p>
    <?php endif; ?>
    <br>
    Текст поста:<br>
    <textarea name="content"><?= $post['content'] ?? $content ?? '' ?></textarea>
    <?php if (!empty($errors['content'])): ?>
        <p style="color:red"><?= $errors['content'] ?></p>
    <?php endif; ?>
    <br><br>
    <input type="submit" value="Изменить">


</form>
</body>
</html>
