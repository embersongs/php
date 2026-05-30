<?php
namespace CompanyName\Blog\Controllers;

//Вызывается в index динамически через $page . 'Controller'()
use function CompanyName\Blog\Models\getPosts;
use function CompanyName\Blog\Models\getPost;
use function CompanyName\Blog\render;
use function CompanyName\Blog\Models\updatePost;
use function CompanyName\Blog\Models\getCategories;

function postEditController(): void
{

    $category_id = null;
    $post = [];

    /*
    C - Edit
    Процедура:
    1. Нажимаем "edit", передаем id-поста, который хотим изменить
    2. По этому id получаем даныые поста и выводим их в форму для правки и передаем этот id тоже, данные в $posts
    3. Принимаем измененные данные поста вместе с его id
        а) нет ошибок валидации, сохраняем изменения и делаем редирект на это пост по id
        б) ошибки есть, выводим их в эту же форму, данные формы в переменных $title и  т.п.

    */
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'edit':
            //показать форму и вывести на ней данные поста для правки
            $id = (int)$_GET['id'];
            $post = getPost($id);
            break;

        case 'save':
            //принять новые исправленные данные поста и сохранить его
            $id = (int)($_POST['id'] ?? null);
            $title = htmlspecialchars($_POST['title'] ?? '');
            $content = htmlspecialchars($_POST['content'] ?? '');
            $category_id = (int)($_POST['category_id'] ?? null);

            //Валидация
            if (empty($title)) {
                $errors['title'] = 'Заполните поле title';
            }

            if (empty($content)) {
                $errors['content'] = 'Заполните поле text';
            }
            $validated = [
                'id' => $id,
                'category_id' => $category_id,
                'title' => $title,
                'content' => $content
            ];
            if (empty($errors)) {

                updatePost($validated);

                header("Location: /?page=post&id=$id&success=edit");
                die();
            }
            break;
        default:
            throw new \OutOfBoundsException("Не верный action");

    }
    $categories = getCategories();

    echo render('posts/edit', [
        'post' => $post,
        'categories' => $categories,
        'title' => $title ?? '',
        'category_id' => $category_id,
        'content' => $content ?? '',
        'errors' => $errors ?? null,
        'id' => $id
    ]);
}

function postCreateController(): void
{

    $categories = getCategories();
    $category_id = null;
    //C - Create
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $extensionMimeMap = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
                'webp' => 'image/webp'
            ];
            $maxFileSize = 5 * 1024 * 1024;
            if ($_FILES['image']['size'] > $maxFileSize) {
                $errors['image'] = 'Файл слишком большой';
            }
            $uploadDir = 'upload/';
            $fileName = $_FILES['image']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!array_key_exists($fileExtension, $extensionMimeMap)) {
                $errors['image'] = 'Не правильный тип файла';
            }
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $detectedMimeType = finfo_file($finfo, $_FILES['image']['tmp_name']);

            $ext = $extensionMimeMap[$fileExtension] ?? '';

            if ($ext !== $detectedMimeType) {
                $errors['image'] = 'Не правильный тип файла';
            }
            $safeFileName = uniqid() . '_' . date('Y-m-d_H-i-s') . '.' . $fileExtension;

            if (!isset($errors['image'])) {
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $safeFileName)) {
                    $errors['image'] = 'Файл не загружен';
                }
            }
        }

        $title = htmlspecialchars($_POST['title'] ?? '');
        $content = htmlspecialchars($_POST['content'] ?? '');
        $category_id = (int)($_POST['category_id'] ?? null);


        //Валидация
        if (empty($title)) {
            $errors['title'] = 'Заполните поле title';
        }

        if (empty($content)) {
            $errors['content'] = 'Заполните поле text';
        }

        if (empty($errors)) {
            $posts = getPosts();

            $posts[] = [
                'category_id' => $category_id,
                'title' => $title,
                'content' => $content,
                'date' => date('Y-m-d H:i'),
                'author' => 'Guest'

            ];

            $lastKey = array_key_last($posts);
            $posts[$lastKey]['id'] = $lastKey;

            $posts[$lastKey] = array_merge(['id' => $lastKey], $posts[$lastKey]);
            $posts[$lastKey]['image'] = $safeFileName ?? null;

            // savePost($post);
            file_put_contents(dirname(__DIR__) . '/data/posts.json', json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            header("Location: /?page=post&id=$lastKey&success=ok");
            die();
        }

    }

    echo render('posts/create', [
        'categories' => $categories,
        'title' => $title ?? '',
        'category_id' => $category_id,
        'content' => $content ?? '',
        'errors' => $errors ?? null,
    ]);
}

function postController(): void
{
    $success = isset($_GET['success']) ? (STATUSES[$_GET['success']] ?? null) : null;

    $id = $_GET['id'] ?? null;

    //Валидация
    if (is_null($id)) {
        throw new \OutOfBoundsException('ID поста не передан');
    }

    if (!is_numeric($id)) {
        throw new \OutOfBoundsException('ID поста должен быть числом');
    }


    $post = getPost($id);

    if (isset($_GET['action']) && $_GET['action'] === 'addlike' && isset($_GET['ajax'])) {

        if (isset($post['likes'])) {
            $post['likes'] = (int) $post['likes'] + 1;
        } else {
            $post['likes'] = 1;
        }
        updatePost($post);

        $result = [
            'status' => 'success',
            'likes' => $post['likes'],
        ];


        header('Content-Type: application/json');
        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;

    }

    echo render('posts/show', [
        'post' => $post,
        'success' => $success
    ]);

}

function postsController(): void
{

    $success = isset($_GET['success']) ? (STATUSES[$_GET['success']] ?? null) : null;

    $posts = getPosts();

    //D - Delete
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $id = $_GET['id'] ?? null;
        //deletePost($id)
        unset($posts[$id]);
        file_put_contents(dirname(__DIR__) . '/data/posts.json', json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        if (isset($_GET['ajax'])) {
            if (empty($errors)) {
                $result = [
                    'status' => 'success'
                ];
            } else {
                $result = [
                    'status' => 'error'
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }

        header("Location: /?page=posts&success=delete");
        die();
    }

    echo render('posts/index', [
        'posts' => $posts,
        'success' => $success,
    ]);
}