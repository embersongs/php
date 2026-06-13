<?php
//как подключиться к БД
$db = new PDO("sqlite:database.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//Как читать и записывать данные
$stmt = $db->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();

$stmt = $db->query("SELECT * FROM posts");
$posts = $stmt->fetchAll();

print_r($posts);
