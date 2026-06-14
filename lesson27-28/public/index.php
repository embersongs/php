<?php

require __DIR__ . '/../vendor/autoload.php';

use function CompanyName\Blog\redirectToError;

const STATUSES = [
    'ok' => 'Пост успешно создан',
    'delete' => 'Пост успешно удален',
    'edit' => 'Пост успешно изменен',
    'info' => 'Поздравляю',
];


$page = (string)($_GET['page'] ?? 'index');

$controllerFunctionName = "CompanyName\\Blog\\Controllers\\" . $page . "Controller";



try {
    if (function_exists($controllerFunctionName)) {
        $controllerFunctionName();
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
    redirectToError(404, $e->getMessage(), $errorId);

} catch (Exception $e) {
    $errorDetails = [
        'message' => $e->getMessage(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ];
    error_log(json_encode($errorDetails, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    var_dump($errorDetails);
    die();
    redirectToError(500);
}
