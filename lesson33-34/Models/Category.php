<?php

namespace App\Models;

class Category extends Model
{

    static protected function getTableName(): string
    {
        return 'categories';
    }
}