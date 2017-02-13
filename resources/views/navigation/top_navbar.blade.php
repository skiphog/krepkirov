<nav class="krep-navbar uk-navbar">

    <a class="krep-brand" href="/">
        <img class="uk-margin uk-margin-remove" src="/images/logo.png" width="50" height="50" title="logo" alt="logo">
        <span class="uk-hidden-small">Крепежные материалы</span>
    </a>

    <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav">
            @if (Auth::check())
                @if(Auth::user()->isAdmin())
                    <li><a href="{{ url('/admin') }}">Админка</a></li>
                @endif
                <li><a href="#">{{ Auth::user()->name }}</a></li>
            @else
                <li><a href="{{ url('/login') }}">Войти</a></li>
                <li><a href="{{ url('/register') }}">Регистрация</a></li>
            @endif
        </ul>
    </div>

</nav>