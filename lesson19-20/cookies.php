<?php

if (isset($_POST['reset'])) {
    setcookie("counter", "", time() - 36000, "/");
    header("Location: /");
    exit;
}
//counterv=5
//формирование header SetCookie чтобы браузер создал куку
if (isset($_COOKIE['counter'])) {
    $counter = (int)$_COOKIE['counter'] + 1;
} else {
    $counter = 1;
}

setcookie("counter", $counter, time() + 36000, "/");


?>
Число посещений страницы <?=$counter?>

<form action="" method="post">
    <input type="submit" name="reset" value="Сбросить счётчик">
</form>