<nav class="uk-navbar">
    <div class="uk-navbar-left">
        <a class="uk-navbar-item uk-logo" href="/">
            <img src="/images/logo.png" width="50" height="50" alt="logo">
            <span class="uk-margin-left">Крепежные материалы</span>
        </a>
    </div>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            @if (Auth::check())
                <li><a href="#">{{ Auth::user()->name }}</a></li>
            @else
                <li><a href="{{ url('/login') }}">Войти</a></li>
                <li><a href="{{ url('/register') }}">Регистрация</a></li>
            @endif
        </ul>
    </div>
</nav>