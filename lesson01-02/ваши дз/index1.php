<?php
//Написать скрипт обмена переменными x <-> y
$x = 10;
$y = 25;

[$x, $y] = [$y, $x];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   x = <?=$x?>, y = <?=$y?>
</body>
</html>
