<?php
// router.php
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Пропускаем реальные файлы
$public_file = __DIR__ . '/public' . $path;
if (file_exists($public_file) && is_file($public_file)) {
    return false;
}


$_GET['route'] = ltrim($path, '/');

include __DIR__ . '/public/index.php';
exit; // явно завершаем