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

Route::prefix('posts')
    ->name('posts.')
    ->controller(PostController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{post}', 'show')->name('show');
        Route::get('/category/{category:slug}', 'category')->name('category');
    });

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', AdminController::class)->name('index');
        Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [AdminPostController::class, 'store'])->name('posts.store');
        Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('posts.update');
    });



//Route::get('/admin/categories', [AdminPostController::class, 'index'])->name('admin.categories.index');
