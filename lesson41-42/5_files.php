<?php
//уязвимость через загружаемый файл

//уязвимость
if (isset($_FILES['file'])) {
    $target = "uploads/" . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $target);
}
//virus.php

//защита
$uploadDir = __DIR__ . '/uploads/';
$filename = basename($_FILES['file']['name']);
$extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
//finfo_file()
$allowed = ['jpg', 'jpeg', 'png', 'pdf'];

if (!in_array($extension, $allowed)) {
    die('Недопустимый тип файла');
}

// Генерируем новое имя
$newName = bin2hex(random_bytes(16)) . '.' . $extension;
$targetPath = $uploadDir . $newName;

if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
    echo "Файл успешно загружен";
}

//хранить вне public (storage)
//запрет на выполнение файлов в загрузке
//ограничить размер
//проверять mime
//использовать библиотеки