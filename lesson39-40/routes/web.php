<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('home');


/*Route::prefix('posts')
    ->name('posts.')
    ->controller(PostController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->where('id', '[0-9]+')->name('show');
    });*/

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+')->name('posts.show');

Route::get('/admin', AdminController::class)->name('admin.index');
Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
//Route::get('/admin/categories', [AdminPostController::class, 'index'])->name('admin.categories.index');
