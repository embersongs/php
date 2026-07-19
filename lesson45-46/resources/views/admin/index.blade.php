@extends('layouts.app')

@section('title', 'Админка главная')

@section('menu')
    @include("components.admin.menu")
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Добро пожаловать в админку</div>
                    <div class="card-body">

                        <h3>Статистика</h3>
                        <p>Всего Категорий: {{ $totalCategories }}</p>
                        <p>Всего Постов: {{ $totalPosts }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
