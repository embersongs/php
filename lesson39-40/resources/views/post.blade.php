@extends('layouts.main')

@section('content')
    @if (!is_null($post))
        <h2>{{ $post->title }}</h2>
        <p>{!! nl2br(e($post->content)) !!}  </p>
    @else
        Нет такого поста
    @endif

@endsection
