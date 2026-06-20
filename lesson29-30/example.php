<?php

class Model
{
    protected static PDO $db;

    public static function setConnection(PDO $db): void
    {
        self::$db = $db;
    }

    public function save()
    {
        //INSERT usert
        echo "Сохраним в таблицу " . static::tableName() . PHP_EOL;
    }
}

class User extends Model
{
    public string $name;


    protected static function tableName(): string
    {
        return 'users';
    }
}

class Post extends Model
{
    public string $title;

    protected static function tableName(): string
    {
        return 'posts';
    }
}
//Active Record
$user = new Post();
$user->title = "Заголовок";
$user->save();
