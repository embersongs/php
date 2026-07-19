<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Определяем, может ли пользователь просматривать список постов
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Определяем, может ли пользователь просматривать конкретный пост
     */
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Определяем, может ли пользователь создавать посты
     */
    public function create(User $user): bool
    {
        return false; // Все авторизованные могут создавать
    }

    /**
     * Определяем, может ли пользователь обновлять пост
     */
    public function update(User $user, Post $post): bool
    {
        // Админ может всё

        if ($user->isAdmin()) {
            return true;
        }


        // Обычный пользователь может править только свои посты
        return $post->isAuthor($user);
    }

    /**
     * Определяем, может ли пользователь удалять пост
     */
    public function delete(User $user, Post $post): bool
    {
        // Админ может всё
       if ($user->isAdmin()) {
            return true;
        }


        // Обычный пользователь может удалять только свои посты
        return $post->isAuthor($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}
