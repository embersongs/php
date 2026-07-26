@extends('layouts.app')

@section('title', 'Crud Users')

@section('menu')
    @include("components.admin.menu")
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                <div class="card">
                    <div class="card-header">CRUD users</div>

                    <div class="card-body" id="container__users">

                        @foreach($users as $user)
                            <div
                                class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded {{ $user->is_admin ? 'bg-danger text-white' : '' }}">

                                <div class="fw-bold text-truncate me-3" style="max-width: 70%;">
                                    {{ $user->name }}
                                </div>


                                <div class="d-flex align-items-center">
                                    <input

                                        @if($user->is_admin) checked @endif
                                    type="checkbox"
                                        class="js:toggleIsAdmin"
                                        data-id="{{ $user->id }}"
                                        data-url="{{ route('admin.toggle', $user) }}"
                                    >&nbsp;

                                    <form action="{{ route('admin.toggle', $user) }}" method="POST" class="mb-0">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm {{ $user->is_admin ? 'btn-outline-light' : 'btn-outline-danger' }}">
                                            {{ $user->is_admin ? 'Убрать админа' : 'Сделать админом' }}
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
    <script>
        const usersContainer = document.querySelector('#container__users');

        if (usersContainer) {
            usersContainer.addEventListener('click', (event) => {
                const { target: { classList, dataset: { id, url } }  } = event;
                if (classList.contains('js:toggleIsAdmin')) {
                    toggleIsAdmin(id, url)
                }
            });
        }

        function toggleIsAdmin(userId, url) {
            console.log({ userId, url })
            const token = document.querySelector('meta[name="csrf-token"]');
            fetch(url,{
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': token?.content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ userId })
            })
            location.reload();


        }
    </script>
@endsection
