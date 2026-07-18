@extends('layouts.admin')

@section('content')
    <h2>Создать пост</h2>

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        <label for="">Заголовок поста</label>
        <input type="text" name="title">
        <br>

        <label for="">Категория</label>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>

        <textarea name="content"></textarea>
        <input type="submit">
    </form>

@endsection
