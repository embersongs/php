<?php

namespace App\Controllers;

use App\Core\Render;

class Controller
{

    protected Render $render;


    public function __construct()
    {
        $this->render = new Render();
    }



}