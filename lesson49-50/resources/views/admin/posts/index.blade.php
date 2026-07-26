@extends('layouts.app')

@section('title', 'Все посты')

@section('menu')
    @include("components.admin.menu")
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">



                <div class="card">
                    <div class="card-header">CRUD посты</div>

                    <div class="card-body">
                        <a type="button" class="btn btn-success" href="{{ route('admin.posts.create') }}">Создать
                            пост</a>

                        @foreach($posts as $post)
                            <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">

                                <div class="fw-bold text-truncate me-3" style="max-width: 70%;">
                                    {{ $post->title }}
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.posts.edit', $post) }}" type="button"
                                       class="btn btn-primary btn-sm">Править</a>

                                    <form action="{{ route('admin.posts.destroy', $post) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Вы уверены, что хотите удалить этот пост?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Удалить">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
