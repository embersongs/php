<?php

namespace App\Models;

class Category extends Model
{
    protected ?string $id;
    protected ?string $name;
    protected ?string $slug;

    protected array $fillable = [
        'name' => false,
        'slug' => false
    ];


    public function __construct(?string $name = null, ?string $slug = null)
    {
        $this->name = $name;
        $this->slug = $slug;
    }


    static protected function getTableName(): string
    {
        return 'categories';
    }
}