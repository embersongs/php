<?php

namespace App\Controllers;

class IndexController extends Controller
{
    public function actionIndex()
    {
        echo $this->render->render('index');
    }
}