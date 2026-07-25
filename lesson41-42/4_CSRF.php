<?php
//защита форм (данные из формы может отправить злоумышленник) и не только из формы
//уязвимость
?>
злоумышленник создает страницу:
<body>
<h1>Посмотри смешную картинку!</h1>
<img src="https://shop.ru/delete?id=5">
</body>
При загрузке такого изображения будет от имени пользователя (с его кукой и авторизацией) отправлен запрос.
Если post запрос, используется скрытая форма

<form action="https://shop.ru/delete" method="POST">
    <input type="hidden" name="id" value="5">
</form>

<script>
    document.forms[0].submit();
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Удаляем статью по ID
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM posts WHERE id = $id");
}

//защита
// Генерация токена (при показе формы)
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
В форме:
<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
<?php
// Проверка
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('CSRF attack detected');
}
?>
SameSite=Strict чтобы кука не отправилась с чужого сайта

// Установка флага SameSite
session_set_cookie_params([
    'samesite' => 'Strict',
    'secure' => true,
    'httponly' => true
]);

?>
