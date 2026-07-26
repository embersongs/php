@extends('layouts.app')

@section('title', 'Админка создать пост')

@section('menu')
    @include("components.admin.menu")
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Создать пост</div>

                    <div class="card-body">



                        <form method="POST" action="{{ route('admin.posts.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Заголовок</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title') }}" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="category" class="col-md-4 col-form-label text-md-end">
                                    Категория
                                </label>
                                <div class="col-md-6">
                                    <select class="form-select" name="category_id" id="category">
                                        @forelse($categories as $category)
                                            <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                            <option value="0">Нет категорий</option>
                                        @endforelse
                                    </select>
                                    @error('category_id')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="users" class="col-md-4 col-form-label text-md-end">
                                    Пользователи
                                </label>
                                <div class="col-md-6">
                                    <select class="form-select" name="user_id" id="user">
                                        @forelse($users as $user)
                                            <option {{ old('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                        @empty
                                            <option value="0">Нет пользователей</option>
                                        @endforelse
                                    </select>
                                    @error('user_id')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Текст поста</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('content') is-invalid @enderror"
                                              name="content">{{ old('content') }}</textarea>


                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Создать
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
