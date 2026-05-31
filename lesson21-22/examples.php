<?php
//Авторизация (допуск к действию или ресурсу)
if (isset($_SESSION['isAdmin'])) {
    $isAdmin = $_SESSION['isAdmin'];
}
if ($isAdmin)  //показываем админку или выполняем действие админа

//Аутентификация (проверка на входе)
//     Идентификация
if ($login === 'admin' && $password === '123') {
    $_SESSION['isAdmin'] = true;
}

