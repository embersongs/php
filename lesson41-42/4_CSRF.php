<?php
//защита форм (данные из формы может отправить злоумышленник) и не только из формы
//уязвимость
?>
<img src="/delete?id=5">
<form action="/transfer">
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

// Установка флага SameSite
session_set_cookie_params([
    'samesite' => 'Strict',
    'secure' => true,
    'httponly' => true
]);