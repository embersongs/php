<?php

namespace App\Models;

//Active Record, будет содержать в свойствах поля из таблицы posts
//и будет содержать методы для работы с этой записью


class Post extends Model
{
    public int $id;
    public string $title;
    public string $content;
    public int $category_id;

    protected static function getTableName(): string
    {
        return 'posts';
    }

}