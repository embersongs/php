<?php
//выполнить команду злоумышленника


//уязвимость
$data = $_POST['data']; //dir
echo `$data`;

$ip = $_GET['ip'];
exec("ping -c 4 " . $ip); //| rm rf
shell_exec("ping -c 4 " . $ip);
system("ping -c 4 " . $ip);
passthru("ping -c 4 " . $ip);

//защита не использовать команды
$ip = $_GET['ip'];

if (!filter_var($ip, FILTER_VALIDATE_IP)) {
    die('Неверный IP-адрес');
}

exec("ping -c 4 " . escapeshellarg($ip), $output);