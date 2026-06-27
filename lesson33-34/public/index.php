<?php


use App\Core\Render;
use App\Core\Request;

require_once __DIR__ . "/../vendor/autoload.php";


$request = new Request();

$controllerName = $request->getControllerName() ?: 'index';
$actionName = $request->getActionName();

$controllerClass = "App\\Controllers\\" . $controllerName . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
} else {
    die("Нет такого контроллера");
}











