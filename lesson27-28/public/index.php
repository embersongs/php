<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/app.php';
$routes = require __DIR__ . '/../config/routes.php';

use function CompanyName\Blog\redirectToError;

const STATUSES = [
    'ok' => 'Пост успешно создан',
    'delete' => 'Пост успешно удален',
    'edit' => 'Пост успешно изменен',
    'info' => 'Поздравляю',
];

//Фронт контроллер
$url_array = explode('/', trim($_SERVER['REQUEST_URI'] ?? '/', '/'));
$page = $url_array[0] ?: 'index';

if (isset($url_array[1])) {
    if (is_numeric($url_array[1])) {
        $id = (int)$url_array[1];
        $action = 'index';
    } else {
        $action = $url_array[1];
        $id = isset($url_array[2]) && is_numeric($url_array[2]) ? (int)$url_array[2] : null;
    }
} else {
    $action = 'index';
    $id = null;
}

//$page = (string)($_GET['page'] ?? 'index');

$controllerFunctionName = "CompanyName\\Blog\\Controllers\\" . $page . "Controller";
//$controllerFunctionName = "CompanyName\\Blog\\Controllers\\" . $page . ucfirst($action) . "Controller";


try {
    if (function_exists($controllerFunctionName)) {
        $controllerFunctionName($action, $id); //postSaveController
    } else {
        throw new OutOfBoundsException("Нет такого контроллера страницы");
    }


} catch (OutOfBoundsException $e) {

    $errorId = 'ERR_' . date('Ymd_His') . '_' . uniqid();
    $errorDetails = [
        'message' => $e->getMessage(),
        'errorId' => $errorId,
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ];
    error_log(json_encode($errorDetails, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


    if (isset($_GET['ajax'])) {

        $result = [
            'status' => 'error',
            'message' => $e->getMessage(),
        ];


        header('Content-Type: application/json');
        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();
    }

    //Редирект
    if (DEBUG === true) {
        var_dump($errorDetails);
    } else {
        redirectToError(404, $e->getMessage(), $errorId);
    }


} catch (Exception $e) {
    $errorDetails = [
        'message' => $e->getMessage(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ];
    error_log(json_encode($errorDetails, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    redirectToError(500);
}
