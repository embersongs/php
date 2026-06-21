<?php

namespace App\Models;

//Active Record, будет содержать в свойствах поля из таблицы posts
//и будет содержать методы для работы с этой записью

use App\Traits\TExample;

class Post extends Model
{
    use TExample; //include

    public int $id;
    public string $title;
    public string $content;

    protected function getTableName(): string
    {
        return 'posts';
    }

}