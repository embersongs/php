<?php

namespace App\Models;

//Active Record, будет содержать в свойствах поля из таблицы posts
//и будет содержать методы для работы с этой записью


class Post extends Model
{
    protected ?int $id;
    protected ?string $title;
    protected ?string $content;
    protected ?int $category_id;

    protected array $fillable = [
        'title' => false,
        'content' => false,
        'category_id' => false
    ];

    public function __construct(
        ?string $title = null,
        ?string $content = null,
        ?int $category_id = null
    )
    {
        $this->title = $title;
        $this->content = $content;
        $this->category_id = $category_id;
    }


    protected static function getTableName(): string
    {
        return 'posts';
    }

}