<nav class="krep-navbar uk-navbar">

    <a class="krep-brand" href="{{ url('admin') }}">
        <img class="uk-margin uk-margin-remove" src="/images/logo.png" width="50" height="50" title="logo" alt="logo">
        <span class="uk-hidden-small">Алминка</span>
    </a>

    <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav">
            <li><a href="/">На сайт</a></li>
            <li><a href="#">{{ Auth::user()->name }}</a></li>
        </ul>
    </div>

</nav>

<nav class="krep-navbar uk-navbar uk-margin-bottom">

    <ul class="uk-navbar-nav">
        <li><a href="{{ route('categories.index') }}">Категории</a></li>
        <li><a href="{{ action('Admin\ProductController@index') }}">Товары</a></li>
        <li><a href="{{ url('about') }}">Страницы</a></li>
        <li><a href="{{ url('about') }}">Заказы</a></li>
        <li><a href="{{ url('about') }}">Клинеты</a></li>
    </ul>
</nav>