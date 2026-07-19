@extends('layouts.app')

@section('menu')
    @include("components.admin.menu")
@endsection

@section('content')

    <h2>Создать пост</h2>

    <form action="{{ route('admin.posts.update', $post) }}" method="post">
        @csrf
        @method('put')
        <label for="">Заголовок поста</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}">
        @error('title')
        <div style="color:red">{{ $message }}</div>
        @enderror
        <br>

        <label for="">Категория</label>
        <select name="category_id">
            @foreach($categories as $category)
                <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
        <div style="color:red">{{ $message }}</div>
        @enderror
        <br>

        <textarea name="content">{{ old('content', $post->content) }}</textarea>
        @error('content')
        <div style="color:red">{{ $message }}</div>
        @enderror
        <input type="submit" value="Обновить">
    </form>

@endsection
