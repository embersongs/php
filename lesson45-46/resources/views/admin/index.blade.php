@extends('layouts.app')

@section('menu')
    @include("components.admin.menu")
@endsection

@section('content')
    <h2>Добро пожаловать в админку</h2>

    <h3>Статистика</h3>
    <p>Всего Категорий: {{ $totalCategories }}</p>
    <p>Всего Постов: {{ $totalPosts }}</p>
@endsection
