<?php
session_start();
$isAdmin = false;

if (isset($_SESSION['isAdmin'])) {
    $isAdmin = $_SESSION['isAdmin'];
}

if (isset($_GET['action']) && $_GET['action'] == 'login') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    //Валидация..

    if ($login === 'admin' && $password === '123') {
        $_SESSION['isAdmin'] = true;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        die("Не верный логин пароль");
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['isAdmin']);
    session_destroy();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}