<?php
namespace CompanyName\Blog\Models;

use function CompanyName\Blog\getDb;
use function  CompanyName\Blog\readFileData;
use function CompanyName\Blog\decodeData;

function getCategoryBySlug(string $slug): array
{
    $categories = getCategories();
    $filtered = array_filter($categories, fn($cat) => $cat['slug'] === $slug);

    if (empty($filtered)) {
        throw new \OutOfBoundsException("Категория с slug '{$slug}' не найдена");
    }

    return array_values($filtered)[0];
}

function getCategoryById(int $id): array
{
    $category = getCategories();

    if (!isset($category[$id])) {
        throw new \OutOfBoundsException("Категория не найдена");
    }

    return $category[$id];
}

function getCategories()
{
    $db = getDb();
    $stmt = $db->query("SELECT * FROM categories");
   // $categoriesData = readFileData('categories.json');
    return $stmt->fetchAll();
}

