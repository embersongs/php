@extends('layouts.app')

@section('title', 'Посты категории')

@section('menu')
    @include("components.menu")
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Посты категории {{ $category->name ?? 'нет категории' }}</div>

                    @foreach($posts as $post)
                        <div class="card-body">
                            <h3>Категория: {{ $post->category->name }}</h3>
                            <a href="{{ route('posts.show', $post) }}">
                                {{ $post->title }}
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
