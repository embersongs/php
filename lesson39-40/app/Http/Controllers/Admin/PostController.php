<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        //TODO Вывести список постов
        $posts = Post::query()->orderBy("id", "desc")->get();

        return view('admin.posts', ['posts' => $posts]);
    }
}
