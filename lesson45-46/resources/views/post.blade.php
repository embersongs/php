@extends('layouts.app')

@section('title', 'Пост')

@section('menu')
    @include("components.menu")
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ $post->title }}</div>
                    <div class="card-body">
                        @if (!is_null($post))
                            <h2>{{ $post->title }}</h2>
                            <p>{!! nl2br(e($post->content)) !!}  </p>
                        @else
                            Нет такого поста
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
