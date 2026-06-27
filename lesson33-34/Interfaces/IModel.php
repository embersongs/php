<?php

namespace App\Interfaces;

interface IModel
{
    public static function All();
    public static function find(int $id);
}