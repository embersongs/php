@extends('layouts.main')

@section('content')

    <h2>Все посты</h2>

    @foreach($posts as $post)
        <a href="{{ route('posts.show', $post['id']) }}">{{ $post['title'] }}</a><br>
    @endforeach

@endsection
