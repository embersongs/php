<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Главная</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.posts.index') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">Посты</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">Категории</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Пользователи</a>
</li>

