<?php
session_start();//PHPSSESID
$isAdmin = false;

//Читаем куку save и если она есть и там информация про авторизацию создаем сессию и делаем редирект
//если сессия еще не создана

if (isset($_COOKIE['save']) && !isset($_SESSION['isAdmin'])) {
    $token = $_COOKIE['save'];

    $db = getDb();
    $stmt = $db->prepare("SELECT * FROM `users` WHERE `hash` = :token");
    $stmt->execute([':token' => $token]);
    $user = $stmt->fetch();

    if (isset($user) && !empty($token)) {
        $_SESSION['isAdmin'] = true;
        $_SESSION['user'] = $user['name'];
    }
}

//Авторизация
if (isset($_SESSION['isAdmin'])) {
    $isAdmin = $_SESSION['isAdmin'];
}


if (isset($_GET['action']) && $_GET['action'] === 'login') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    //$hash = '$2y$12$YUhlF9qGuzSqnnBQe6gVJ.9pyD./2Jj4XZM1x8jxGKWmPfRBb1F8e';

    $db = getDb();
    $stmt = $db->prepare("SELECT * FROM `users` WHERE `name` = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();

    //Валидация..

    if ($user !== false && password_verify($password, $user['password'])) {

        if (isset($_POST['save']) && $_POST['save'] == 'on') {
            //Создать куку save
            //сохранить в ней некий токен (ikji849jhf9ejv03jv903v03v9)
            $hash = random_bytes(32) . microtime(true) . uniqid('', true);
            setcookie('save', $hash, time() + (86400 * 30), "/");
            //записать хеш в пользователя в БД
            $stmt = $db->prepare("UPDATE `users` SET `hash` = ? WHERE `id` = ?");
            $stmt->execute([$hash, $user['id']]);
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