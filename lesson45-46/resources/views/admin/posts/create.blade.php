@extends('layouts.admin')

@section('content')

    <h2>Создать пост</h2>

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        <label for="">Заголовок поста</label>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title')
            <div style="color:red">{{ $message }}</div>
        @enderror
        <br>

        <label for="">Категория</label>
        <select name="category_id">
            @foreach($categories as $category)
                <option @selected(old('category_id') == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
        <div style="color:red">{{ $message }}</div>
        @enderror
        <br>

        <textarea name="content">{{ old('content') }}</textarea>
        @error('content')
        <div style="color:red">{{ $message }}</div>
        @enderror
        <input type="submit" value="Создать">
    </form>

@endsection
