<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
       // $categories = DB::table('categories')->get();
        $categories = Category::all();

        return view('posts.categories.index', [
            'categories' => $categories
        ]);
    }

    public function show(Category $category)
    {
       // $category = DB::table('categories')->find($id);
        //$category = Category::findOrFail($id);

        //$posts = DB::table('posts')->where('category_id', $category->id)->get();
      //  $posts = Post::where('category_id', $category->id)->get();

        $posts = $category->posts()->with('category')->get();


        return view('posts.categories.show', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
}
