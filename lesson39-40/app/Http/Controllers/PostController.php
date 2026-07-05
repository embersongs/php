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
        $categories = DB::table("categories")->orderBy("id", "desc")->get();


        return view('posts', [
            'posts' => $posts,
            'categories' => $categories
        ]);
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


    public function category(string $slug)
    {
       // $posts = DB::table("posts")->where('category_id', $id)->orderBy("id", "desc")->get();

        $category = DB::table("categories")->where('slug', $slug)->firstOrFail();

        $posts = DB::table("posts")
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->where('categories.slug', $slug)
            ->select('posts.*', 'categories.name as category_name')
            ->get();



        $categories = DB::table("categories")->orderBy("id", "desc")->get();


        return view('posts', [
            'posts' => $posts,
            'categories' => $categories,
            'category_id' => $category->id
        ]);
    }
}
