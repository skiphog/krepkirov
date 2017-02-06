<nav class="uk-navbar">
    <div class="uk-navbar-left">
        <a class="uk-navbar-item uk-logo" href="{{ url('admin') }}">
            <img src="/images/logo.png" width="50" height="50" alt="logo">
            <span class="uk-margin-left">Админка</span>
        </a>
    </div>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li><a href="/">На сайт</a></li>
            <li><a class="uk-text-bold" href="#">{{ Auth::user()->name }}</a></li>
        </ul>
    </div>
</nav>

<nav class="uk-navbar bottom-bar">
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li><a href="{{ route('categories.index') }}">Категории</a></li>
            <li><a href="{{ url('price') }}">Товары</a></li>
            <li><a href="{{ url('about') }}">Страницы</a></li>
            <li><a href="{{ url('about') }}">Заказы</a></li>
            <li><a href="{{ url('about') }}">Клинеты</a></li>
        </ul>
    </div>
</nav>