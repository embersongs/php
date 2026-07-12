<?php
//слабое хранение паролей
$hash = md5($_POST['password']);

//защита
$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
// Проверка при логине
if (password_verify($_POST['password'], $hash)) {
    // Успешный вход
}

