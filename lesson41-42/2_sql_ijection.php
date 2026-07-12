<?php
//подмена sql-запроса пользовательским вводом

//уязвимость
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = $id"; //user.php?id=1 or 1=1

//защита
$pdo = new PDO("mysql:host=localhost;dbname=test", $dbuser, $dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $_POST['username']]);

$user = $stmt->fetch();

$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE id=:id"
);

$stmt->execute([
    'id'=>$id
]);

//ранее
$password = mysqli_real_escape_string($connection, $password);