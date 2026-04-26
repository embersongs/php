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

