@extends('layouts.app')

@section('title', 'Главная')

@section('menu')
    @include("components.menu")
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Блог') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Добро пожаловать в наш блог!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
