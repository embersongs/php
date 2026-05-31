<?php
//Старт сессии
session_start();

//Запись в сессию данных (любых)
$_SESSION['message'] = "Файл удален";

unset($_SESSION['message']); //Удаление
session_destroy();
session_regenerate_id();
var_dump(session_id());
var_dump($_SESSION);
var_dump($_COOKIE);