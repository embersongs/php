<?php
function getPostsCategoriesBySlug(string $slug): array
{
    $category = getCategoryBySlug($slug);

    return getPostsCategoriesById($category['id']);
}


function getPostsCategoriesById(int $id): array
{
    $posts = getPosts();

    $filteredPosts = array_filter($posts, function ($post) use ($id) {
        return isset($post['category_id']) && $post['category_id'] === $id;
    });

    return array_values($filteredPosts);
}


function getCategoryBySlug(string $slug): array
{
    $categories = getCategories();
    $filtered = array_filter($categories, fn($cat) => $cat['slug'] === $slug);

    if (empty($filtered)) {
        throw new OutOfBoundsException("Категория с slug '{$slug}' не найдена");
    }

    return array_values($filtered)[0];
}

function getCategoryById(int $id): array
{
    $category = getCategories();

    if (!isset($category[$id])) {
        throw new OutOfBoundsException("Категория не найдена");
    }

    return $category[$id];
}

function getCategories()
{
    $categoriesData = readFileData('categories.json');
    return decodeData($categoriesData);
}

function getPost(int $id): array
{
    $posts = getPosts();

    if (!isset($posts[$id])) {
        throw new OutOfBoundsException("Пост не найден");
    }

    return $posts[$id];
}

function getPosts(): array
{
    $postsData = readFileData('posts.json');
    return decodeData($postsData);
}

function decodeData(string $data): array
{
    $parsedData = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

    if (!is_array($parsedData)) {
        throw new RuntimeException('Данные в файле не являются массивом');
    }

    return $parsedData;
}


function readFileData(string $fileName): string
{
    $filePath = dirname(__DIR__) . "/data/$fileName";

    if (!file_exists($filePath)) {
        throw new RuntimeException('Файл не найден');
    }

    $fileData = file_get_contents($filePath);

    if ($fileData === false) {
        throw new RuntimeException('Не удалось прочитать файл');
    }

    if (empty($fileData)) {
        throw new RuntimeException('Файл пуст');
    }

    return $fileData;
}