<?php

namespace App\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        echo $this->render->render('index');
    }
}