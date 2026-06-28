<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {

        $posts = Post::all(); //читаем из модели

        return view('posts', ['posts' => $posts]);
    }

    public function show(int $id)
    {
        //TODO реализовать извлечение одного поста из модели ( Post::find(5))
        if (!isset($this->posts[$id])) {
            abort(404);
        }
        $post = $this->posts[$id];

        return view('post', ['post' => $post]);
    }

}
