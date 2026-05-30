<?php


//формирование header SetCookie чтобы браузер создал куку
if (isset($_COOKIE['counter'])) {
    $counter = (int)$_COOKIE['counter'] + 1;
} else {
    $counter = 1;
}

setcookie("counter", $counter, time() + 36000, "/");


?>
Число посещений страницы <?=$counter?>
