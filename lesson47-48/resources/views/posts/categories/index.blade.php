@extends('layouts.app')

@section('title', 'Все категории')

@section('menu')
    @include("components.menu")
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Все Категории</div>

                    @forelse($categories as $category)
                        <div class="card-body">
                            <a href="{{ route('posts.categories.show', $category) }}">
                                {{ $category->name }}
                            </a>
                        </div>
                    @empty
                        Нет категорий
                    @endforelse


                </div>
            </div>
        </div>
    </div>


@endsection
