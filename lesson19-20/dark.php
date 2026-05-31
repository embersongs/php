<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $theme = $_POST['theme_checkbox'] === 'on' ? 'dark' : 'light';
    setcookie("user_theme", $theme, time() + 30 * 24 * 3600, "/");
    header("Location: /");
    exit;
}
$current_theme = $_COOKIE["user_theme"] ?? 'light';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background-color: <?= $current_theme === 'dark' ? 'grey' : 'white' ?>">

<form action="" method="post">
    <label style="cursor: pointer" for="check">
        <input id="check" type="checkbox" name="theme_checkbox" onclick="this.form.submit()" <?= $current_theme === 'dark' ? 'checked' : '' ?>>
        Темная тема
    </label>


</form>
</body>
</html>
