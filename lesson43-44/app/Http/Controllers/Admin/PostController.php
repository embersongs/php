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
        $posts = Post::query()->orderBy("id", "desc")->paginate(10);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create')->with('categories', $categories); //вариант
    }

    public function store(Request $request)
    {
        //dd($request->all());
/*        $post = new Post();
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->save();*/

        $post = Post::query()->create($request->all());

        return redirect()->route('posts.show', ['post' => $post] );
        //return redirect()->route('admin.posts.index');
    }
}
