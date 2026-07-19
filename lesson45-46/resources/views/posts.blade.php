@extends('layouts.main')

@section('content')

    <h2>Все посты</h2>

    @foreach($categories as $category)
        <a
            @class(['active' => isset($category_id) && $category_id == $category->id])
            href="{{ route('posts.category', $category->slug) }}">{{ $category->name }}
        </a>
    @endforeach
    <br><br>
    @foreach($posts as $post)
        {{ $post->category->name }}:
        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a><br>
    @endforeach
    {{ $posts->links('components.minimal') }}
@endsection
