<?php
//вставки js в страницу

//уязвимость

$comment = $_POST['comment'];
mysqli_query($conn, "INSERT INTO comments (text) VALUES ('$comment')");

// Вывод
echo "<div>{$row['text']}</div>";
//может быть выполнен js, последствия:
//1 кража cookie
//2 подмена страницы
//3 фишинг
//4 отправить запрос от имени пользователя

//защита - экранирование и использование шаблонизаторов (blade, twig)
// При сохранении (опционально)
$comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');

// При выводе (обязательно)
echo "<div>" . htmlspecialchars($row['text'], ENT_QUOTES, 'UTF-8') . "</div>";