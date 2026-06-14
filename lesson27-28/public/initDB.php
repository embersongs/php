<?php

//как подключиться к БД
try {
    $db = new PDO("sqlite:data/database.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Как создавать таблицы
    $sql = file_get_contents('data/database.sql');
    $db->exec($sql);


//Как закрыть подключение к БД
    $db = null;
} catch (Exception $exception) {
    echo $exception->getMessage();
}
