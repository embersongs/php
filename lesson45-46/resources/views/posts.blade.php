@extends('layouts.app')

@section('title', 'Все посты')

@section('menu')
    @include("components.menu")
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Все посты</div>

                    <div class="card-body">
                        @foreach($categories as $category)
                            <a
                                @class(['active' => isset($category_id) && $category_id == $category->id])
                                href="{{ route('posts.category', $category->slug) }}">{{ $category->name }}
                            </a>&nbsp;
                        @endforeach
                        <br><br>
                        @foreach($posts as $post)
                            {{ $post->category->name }}:
                            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a><br>
                        @endforeach

                    </div>

                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>

@endsection
