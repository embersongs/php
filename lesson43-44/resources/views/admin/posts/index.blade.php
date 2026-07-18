@extends('layouts.admin')

@section('content')
    <h2>CRUD постов</h2>
    <a href="{{ route('admin.posts.create') }}">Создать</a><br><br>
    @foreach($posts as $post)
        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a> [edit] [x]<br>
    @endforeach
    {{ $posts->links('components.minimal') }}
@endsection
