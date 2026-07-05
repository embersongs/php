<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        //TODO Вывести список постов
        $posts = DB::table("posts")->orderBy("id", "desc")->get();

        return view('admin.posts', ['posts' => $posts]);
    }
}
