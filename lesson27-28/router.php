<?php

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Пропускаем реальные файлы в папке public
$public_file = __DIR__ . '/public' . $path;
if (file_exists($public_file) && is_file($public_file)) {
    return false;
}

// Все запросы направляем в public/index.php
$_GET['route'] = ltrim($path, '/');
require __DIR__ . '/public/index.php';