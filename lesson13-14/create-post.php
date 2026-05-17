<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
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
<h2>Cоздать пост</h2>
    <form action="?name=alex&age=12" method="post" enctype="application/x-www-form-urlencoded">
        Категория:<br>
        <select name="category_id">
            <option value="0">PHP разработка</option>
            <option value="1">Frontend</option>
        </select><br>

        Заголовок поста:<br>
        <input type="text" name="title"><br>
        Текст поста:<br>

        <textarea name="content"></textarea><br><br>
        <input type="submit" value="Создать">

        <!--
        <input type="checkbox" name="tags[]" value="Политика">
        <input type="checkbox" name="tags[]" value="Жесть">
        <input type="checkbox" name="tags[]" value="Еда">
        -->
    </form>
</body>
</html>
