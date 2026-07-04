<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/app.css">
</head>
<body>
<a href="{{ route('home') }}">Главная</a>
<a href="{{ route('posts.index') }}">Посты</a><br>

@yield('content')
</body>
</html>
