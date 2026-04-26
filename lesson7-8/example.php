<?php
//подключение файлов с кодом

include __DIR__ .'/1/index.php';
include __DIR__ . '/2/index.php';

//обязательное подключение файлов с кодом

require __DIR__ .'/1/index.php';
require __DIR__ . '/2/index.php';


//умное подключение файлов с кодом

include_once __DIR__ .'/1/index.php';
require_once __DIR__ . '/2/index.php';

//Если подключаем файл не из корня
include dirname(__DIR__) . '/2/index.php';

//работа с файлами
//https://www.php.net/manual/ru/function.fopen.php
//https://www.php.net/manual/ru/function.fgets.php


//исключение и обработка ошибок старый подход
$posts = "str1\nstr2";

file_put_contents(__DIR__ . '/posts.txt', $posts);

$str = file_get_contents(__DIR__ . '/posts.txt');
echo $str;

function readFileData(string $filename): ?string //nullable
{
    $data = file_get_contents($filename);
    if ($data === false) {
        return NULL;
    }
    return $data;
}

if (is_null(readFileData('str1'))) {
    die("Ошибка");
}

$str = file_get_contents(__DIR__ . '/posts2.txt');
if (!$str) {
    die("Ошибка");
}
var_dump($str);

//исключение и обработка ошибок

$fileName = 'data.csv';
try {

    if (!file_exists($fileName)) {
        throw new Exception('Нет такого файла');
    }

    if (!is_readable($fileName)) {
        throw new Exception('Нет прав на чтение');
    }

    $data = file_get_contents(__DIR__ . '/data.csv');
    if ($data === false) {
        throw new Exception('Ошибка чтения файла');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

//хранение данных в файлах формат json

$posts = [
    [
        "id" => 1,
        "title" => "Введение в PHP",
        "content" => "PHP - это язык программирования, который широко используется для веб-разработки. Он прост в изучении и мощный в использовании.",
        "date" => "2024-01-15",
        "author" => "Алексей"
    ],
    [
        "id" => 2,
        "title" => "Работа с JSON в PHP",
        "content" => "JSON - отличный формат для хранения и обмена данными. PHP предоставляет функции json_encode и json_decode для работы с ним.",
        "date" => "2024-01-16",
        "author" => "Мария"
    ],
    [
        "id" => 3,
        "title" => "Обработка ошибок в PHP",
        "content" => "Правильная обработка ошибок критически важна для создания надежных приложений. Используйте try-catch блоки и проверяйте результаты функций.",
        "date" => "2024-01-17",
        "author" => "Иван"
    ]
];

$json = json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

file_put_contents(__DIR__ . '/posts.txt', $json);