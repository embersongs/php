<?php

namespace App\Controllers;

use App\Models\Post;

class PostController extends Controller
{

    public function actionIndex()
    {
        $posts = Post::all();

        echo $this->render->render('posts/index', [
            'posts' => $posts
        ]);
    }

    public function actionShow()
    {
        $id = (int)($_GET['id']);
        $post = Post::find($id);

        echo $this->render->render('posts/show', [
            'post' => $post
        ]);
    }
}