<?php
//попытка выйти из папки ../

//уязвимость
include($_GET['page']); //page=../../../etc/passwd


//защита белый список
$pages = [
    'home',
    'about'
];


//запретить вызывать файлы кроме index
if (__FILE__ === $_SERVER['SCRIPT_FILENAME']) {
    die('Access denied');
}