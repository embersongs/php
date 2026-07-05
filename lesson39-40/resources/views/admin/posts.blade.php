@extends('layouts.admin')

@section('content')
    <h2>CRUD постов</h2>

    @foreach($posts as $post)
        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a> [edit] [x]<br>
    @endforeach
@endsection
