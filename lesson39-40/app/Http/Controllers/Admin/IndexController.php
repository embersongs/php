<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke()
    {
        //TODO через DB посчитать число постов и категорий и передать для отображения в шаблон
        $totalCategories = DB::table('categories')->count();
        $totalPosts = DB::table('posts')->count();

        return view('admin.index',
            [
                'totalPosts' => $totalPosts,
                'totalCategories' => $totalCategories
            ]);
    }
}
