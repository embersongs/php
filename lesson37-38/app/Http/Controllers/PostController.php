<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index()
    {
        //$posts = Post::all(); //читаем из модели
        $posts = DB::table("posts")->orderBy("id", "desc")->get();
        return view('posts', ['posts' => $posts]);
    }

    public function show(int $id)
    {
        //$posts = Post::all();
       /*if (!isset($posts[$id])) {
            abort(404);
        }*/
       // $post = $posts[$id];
        $post = DB::table('posts')->find($id);

        return view('post', ['post' => $post]);
    }

}
