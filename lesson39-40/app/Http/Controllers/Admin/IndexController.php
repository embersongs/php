<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        //TODO через DB посчитать число постов и категорий и передать для отображения в шаблон
        return view('admin.index');
    }
}
