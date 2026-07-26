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

                        {{-- Форма фильтра --}}
                        <form method="GET" action="{{ route('posts.index') }}" class="mb-4">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <input type="text" name="filter[title]" value="{{ request('filter.title') }}" class="form-control" placeholder="Поиск по названию">

                                    {{-- Пользователь --}}
                                    <div class="col-md-12">
                                        <label for="user_id" class="form-label">Автор</label>
                                        <select name="filter[user_id]" id="user_id" class="form-select">
                                            <option value="">Все авторы</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"
                                                    @selected(request('filter.user_id') == $user->id)>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label for="category_id" class="form-label">Категория</label>
                                    <select name="filter[category_id]" id="category_id" class="form-select">
                                        <option value="">Все категории</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @selected(request('filter.category_id') == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-auto">
                                    <button type="submit" class="btn btn-primary">Фильтровать</button>
                                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Сбросить</a>
                                </div>
                            </div>
                        </form>

                        {{-- Список постов --}}
                        @forelse($posts as $post)
                            <div class="mb-2">
                                <a href="{{ route('posts.show', $post) }}">
                                    {{ $post->title }}
                                </a>
                                @if($post->category)
                                    <small>— {{ $post->category->name }}</small>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted">Постов не найдено.</p>
                        @endforelse

                    </div>
                </div>

                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
