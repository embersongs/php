<?php

use App\Models\Post;
use App\Models\User;

spl_autoload_register('loader');


function loader($class_name)
{
    $class_name = str_replace(['App\\', '\\'], [__DIR__ . '/../', '/'], $class_name) . '.php';

    if (file_exists($class_name)) {
        require_once $class_name;
    } else {
        die("Class $class_name not found");
    }
}


$post = new Post();
$user = new User();

var_dump($user);


















die();
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


