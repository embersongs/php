<?php

use App\Core\Db;
use App\Models\Post;
use App\Models\User;


require_once __DIR__ . "/../vendor/autoload.php";
//spl_autoload_register('loader');


$post = Post::find(2);
$category = Post::find(1);
dump($category);
dump(get_class_methods($category));




















die();

function loader($class_name)
{

    $class_name = str_replace(['App\\', '\\'], [__DIR__ . '/../', '/'], $class_name) . '.php';

    if (file_exists($class_name)) {
        require_once $class_name;
    } else {
        die("Class $class_name not found");
    }
}

//CRUD для таблицы БД в ООП стиле используя паттерн Active Record
//Объект содержит одну запись, данные в полях объекта, и есть методы для работы с данными

//Read
$posts = Post::all();

//AR - Read одна запись
$post = Post::find(1);

//Update
$post->title = "Новый загловок";
$post->update(); //save();

//Delete
$post->destroy();

//Create
$post = new Post('Заговок');
$post->insert(); //save()


