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
                    <div class="card-header">{{ __('Блог') }}</div>

                    <div class="card-body">

                        Админка главная.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
