<?php
namespace CompanyName\Blog\Controllers;

use function CompanyName\Blog\Models\getCategories;
use function CompanyName\Blog\render;
use function CompanyName\Blog\Models\getCategoryBySlug;
use function CompanyName\Blog\Models\getPostsCategoriesBySlug;


function postsCategoryController(): void
{
    $slug = $_GET['category'] ?? null;

    if (is_null($slug)) {
        throw new \OutOfBoundsException('Slug категории не передан');
    }

    $category = getCategoryBySlug($slug);
    $posts = getPostsCategoriesBySlug($slug);

    echo render('posts/posts-category', [
        'posts' => $posts,
        'category' => $category,
    ]);
}

function categoriesController(): void
{
    $categories = getCategories();

    echo render('categories', [
        'categories' => $categories,
    ]);
}