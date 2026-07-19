<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


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

    public function store(StorePostRequest $request)
    {
        //dd($request->all());
        /*        $post = new Post();
                $post->title = $request->title;
                $post->category_id = $request->category_id;
                $post->content = $request->content;
                $post->save();*/


        try {
            $post = Post::query()->create([
                'user_id' => Auth::id(),
                ...$request->validated()
            ]);

        } catch (\Exception $exception) {
            return redirect()->back()->with("error", $exception->getMessage())->withInput();
        }


        return redirect()->route('posts.show', ['post' => $post])->with("success", "Пост создан успешно");
        //return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);

        try {

            $post->update($request->validated());

        } catch (\Exception $exception) {
            return redirect()->route('admin.posts.index')->with("error", $exception->getMessage());
        }
        return redirect()->route('posts.show', ['post' => $post])->with('success', 'Пост успешно обновлен');
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
        } catch (\Exception $exception) {
            return redirect()->route('admin.posts.index')->with("error", $exception->getMessage());
        }

        return redirect()->route('admin.posts.index')->with('success', "Пост удален");
    }
}
