<?php
session_start();//PHPSSESID
$isAdmin = false;

//Читаем куку save и если она есть и там информация про авторизацию создаем сессию и делаем редирект
//если сессия еще не создана

if (isset($_COOKIE['save']) && !isset($_SESSION['isAdmin'])) {
    $token = $_COOKIE['save'];
    if ($token === 'ikji849jhf9ejv03jv903v03v9') {
        $_SESSION['isAdmin'] = true;
    }
}

//Авторизация
if (isset($_SESSION['isAdmin'])) {
    $isAdmin = $_SESSION['isAdmin'];
}


if (isset($_GET['action']) && $_GET['action'] === 'login') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hash = '$2y$12$YUhlF9qGuzSqnnBQe6gVJ.9pyD./2Jj4XZM1x8jxGKWmPfRBb1F8e';
    //Валидация..

    if ($login === 'admin' && password_verify($password, $hash)) {

        if (isset($_POST['save']) && $_POST['save'] == 'on') {
            //Создать куку save
            //сохранить в ней некий токен (ikji849jhf9ejv03jv903v03v9)
            setcookie('save', 'ikji849jhf9ejv03jv903v03v9', time() + (86400 * 30), "/");
        }
//https
        $_SESSION['isAdmin'] = true;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        //редирект обратно с сообщением не правильный логин-пароль
        die("Не верный логин пароль");
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['isAdmin']);
    session_destroy();
    setcookie('save', 'ikji849jhf9ejv03jv903v03v9', time() - (86400 * 30), "/");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}