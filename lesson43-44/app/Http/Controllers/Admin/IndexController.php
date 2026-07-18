<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke()
    {
        //TODO через DB посчитать число постов и категорий и передать для отображения в шаблон
        $totalCategories = Category::query()->count();
        $totalPosts = Post::query()->count();

        return view('admin.index',
            [
                'totalPosts' => $totalPosts,
                'totalCategories' => $totalCategories
            ]);
    }
}
