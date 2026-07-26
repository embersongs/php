<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMyPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        //Извлечь из модели посты
      //  $posts = DB::table('posts')->get();
        $posts = Post::query()->paginate(10);

        return view('posts.index', ['posts' => $posts]);
    }

    public function myPosts()
    {
        $posts = Auth::user()->posts()->latest()->get();

        return view('posts.my.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        //$post = DB::table('posts')->find($id);
        //$post = Post::find($id);

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('posts.my.create', [
                'categories' => $categories,
                'users' => $users]
        );
    }

    public function store(StoreMyPostRequest $request)
    {


        try {

            $post = new Post($request->validated());
            $post->user_id = Auth::id();
            $post->save();

            return redirect()->route('posts.my')
                ->with('success', 'Пост успешно создан!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Произошла ошибка при создании поста: ' . $e->getMessage())
                ->withInput();
        }

    }

    public function edit(Post $post)
    {

        $categories = Category::all();
        $users = User::all();

        return view('posts.my.edit', [
            'post' => $post,
            'categories' => $categories,
            'users' => $users
        ]);
    }

    public function update(StoreMyPostRequest $request, Post $post)
    {



        try {
            $this->authorize('update', $post);


            $post->update($request->validated());

            // Редирект с сообщением об успехе
            return redirect()->route('posts.my')
                ->with('success', 'Пост успешно обновлен!');

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Произошла ошибка при обновлении поста: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Post $post)
    {

        // Авторизация через Policy
        try {

            $this->authorize('delete', $post);
            // Удаляем пост
            $postTitle = $post->title;
            $post->delete();

            return redirect()->route('posts.my')
                ->with('success', "Пост \"{$postTitle}\" успешно удален!");

        } catch (\Exception $e) {
            return redirect()->route('posts.my')
                ->with('error', 'Ошибка удаления поста: ' . $e->getMessage());
        }
    }

}
