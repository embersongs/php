<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Извлечь из модели посты
        $posts = Post::query()->orderByDesc('id')->paginate(10);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::all();

        return view('admin.posts.create', [
                'categories' => $categories,
                'users' => $users]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {


       try {
           Post::create($request->validated());

           return redirect()->route('admin.posts.index')
               ->with('success', 'Пост успешно создан!');

       } catch (\Exception $e) {
           return redirect()->back()
               ->with('error', 'Произошла ошибка при создании поста: ' . $e->getMessage())
               ->withInput();
       }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $users = User::all();
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {

        try {
            $post->update($request->validated());


            // Редирект с сообщением об успехе
            return redirect()->route('admin.posts.index')
                ->with('success', 'Пост успешно обновлен!');

        } catch (\Exception $e) {
            // Обработка ошибок базы данных
            return redirect()->back()
                ->with('error', 'Произошла ошибка при обновлении поста: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {

            // Удаляем пост
            $postTitle = $post->title;
            $postTitle = $post::title;
            $post->delete();

            return redirect()->route('admin.posts.index')
                ->with('success', "Пост \"{$postTitle}\" успешно удален!");

        } catch (\Exception $e) {
            return redirect()->route('admin.posts.index')
                ->with('error', 'Ошибка при удалении поста: ' . $e->getMessage());
        }
    }
}
