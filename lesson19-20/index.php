<?php
//Старт сессии
session_start();

//Запись в сессию данных (любых)
$_SESSION['message'] = "Файл удален";

var_dump($_SESSION);