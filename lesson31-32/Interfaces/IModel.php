<?php

namespace App\Interfaces;

interface IModel
{
    public function All();
    public function find(int $id);
}