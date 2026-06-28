<?php

namespace App\Controllers;

use App\Core\Request;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{

    //post
    public function index()
    {
        $posts = Post::all();

        echo $this->render->render('posts/index', [
            'posts' => $posts
        ]);
    }

    //post/5
    public function show(int $id)
    {
        $post = Post::find($id);

        echo $this->render->render('posts/show', [
            'post' => $post
        ]);
    }

    public function edit(int $id, string $name)
    {
        dump($id, $name);
    }
    
    public function create()
    {
       $categories = Category::all();
       
       echo $this->render->render('posts/create', [
           'categories' => $categories
       ]);
        
    }
    
    
    public function save()
    {
        $post = new Post();
        $post->save();

        return $this->redirect('');
    }
}