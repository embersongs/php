<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index()
    {
        //$posts = Post::all(); //читаем из модели
        //$posts = DB::table("posts")->orderBy("id", "desc")->get();

       // $categories = DB::table("categories")->orderBy("id", "desc")->get();
        $categories = Category::all();
        $posts = Post::query()->paginate(10);


        return view('posts', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function show(Post $post)
    {
        //$posts = Post::all();
       /*if (!isset($posts[$id])) {
            abort(404);
        }*/
       // $post = $posts[$id];
       // $post = DB::table('posts')->find($id);
       // $post = Post::query()->find($id);

        return view('post', ['post' => $post]);
    }


    public function category(Category $category)
    {
       // $posts = DB::table("posts")->where('category_id', $id)->orderBy("id", "desc")->get();

      //  $category = Category::with('posts')->where('slug', $slug)->firstOrFail();

        $posts = $category->posts()->with('category')->paginate(10);

//dump($posts);
/*        $posts = Post::query()
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->where('categories.slug', $slug)
            ->select('posts.*', 'categories.name as category_name')
            ->get();*/



        $categories = Category::query()->orderBy("id", "desc")->get();


        return view('posts', [
            'posts' => $posts,
            'categories' => $categories,
            'category_id' => $category->id
        ]);
    }
}
