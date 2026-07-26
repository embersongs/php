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
                        {{ $post->content }}
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
