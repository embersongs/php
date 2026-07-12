<?php
//кража PHPSSID

//уязвимость троян и http

//защита
session_start();
//авторизовали по логину паролю header редирект
session_regenerate_id(true);

// Установка флага SameSite
session_set_cookie_params([
    'samesite' => 'Strict',
    'secure' => true,
    'httponly' => true
]);
$value = '';
setcookie('session_id', $value, [
    'expires' => time() + 3600,
    'path' => '/',
    'domain' => 'example.com',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

//настройка сессии
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);           // только HTTPS
ini_set('session.use_strict_mode', 1);         // предотвращает fixation
ini_set('session.cookie_samesite', 'Strict');

session_start();

//привязка сессии
$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT']; //fingerprint
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

// При каждом запросе проверять
if ($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] ||
    $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']) {
    session_destroy();
    // перенаправить на логин
}

//защита от подбора
$attempts = (int) $_SESSION['login_attempts'] ?? 0;
$lastAttempt = $_SESSION['last_attempt'] ?? 0;

if (time() - $lastAttempt < 300 && $attempts >= 5) { // 5 попыток за 5 минут
    die('Слишком много попыток. Попробуйте позже.');
}

if (true/* неверный пароль */) {
    $_SESSION['login_attempts'] = $attempts + 1;
    $_SESSION['last_attempt'] = time();
}

//ограничивание срока жизни токена, 2FA