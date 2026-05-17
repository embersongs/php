<?php
var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $arg1 = $_POST["arg1"] ?? 0;
    $arg2 = $_POST["arg2"] ?? 0;

    //валидация ввода


    $result = $arg1 + $arg2;

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body
<?php include __DIR__ . '/components/menu.php' ?>
<h2>Калькулятор</h2>
<form action="" method="post">
    <input type="text" name="arg1" value="<?=$arg1 ?? 0?>">
    <input type="submit" name="operation" value="+">
    <input style="border: 2px solid green" type="submit" name="operation" value="-">
    <input type="text" name="arg2" value="<?=$arg2 ?? 0?>">
    =
    <input type="text" readonly value="<?=$result ?? 0?>">
</form>
</body>
</html>
