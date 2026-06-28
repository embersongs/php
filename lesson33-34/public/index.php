<?php

use App\Controllers\IndexController;
use App\Controllers\PostController;
use App\Core\Router;

require_once __DIR__ . "/../vendor/autoload.php";


$router = new Router();

$router->addRoute('GET', '/', [IndexController::class, 'index']);
$router->addRoute('GET', '/posts', [PostController::class, 'index']);
$router->addRoute('GET', '/posts/{id}', [PostController::class, 'show']);
$router->addRoute('GET', '/posts/{id}/edit/{name}', [PostController::class, 'edit']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$router->route($method, $uri);











