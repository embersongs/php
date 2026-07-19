@extends('layouts.admin')

@section('content')
    <h2>CRUD постов</h2>
    <a href="{{ route('admin.posts.create') }}">Создать</a><br><br>


    @foreach($posts as $post)
        <div style="margin-bottom: 10px; border: 1px solid black; padding: 5px">
            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>

            <a href="{{ route('admin.posts.edit', $post) }}">[edit]</a>

            <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                @method('delete')
                <button type="submit">[x]</button>
            </form>

        </div>


    @endforeach
    {{ $posts->links('components.minimal') }}
@endsection
