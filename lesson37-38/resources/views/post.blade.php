@extends('layouts.main')

@section('content')
    @if (!is_null($post))
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
    @else
        Нет такого поста
    @endif

@endsection
