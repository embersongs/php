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
                        @foreach($posts as $post)
                            <div>
                                <a href="{{ route('posts.show', $post) }}">
                                    {{ $post->title }}
                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>
            {{ $posts->links() }}
            </div>
        </div>
    </div>

@endsection
