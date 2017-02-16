<nav class="krep-navbar uk-navbar uk-margin-small-bottom">

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

<nav class="krep-navbar uk-navbar uk-margin-bottom">

    <ul class="uk-navbar-nav">
        <li><a href="{{ url('catalog') }}">Каталог</a></li>
        <li><a href="{{ url('prices') }}">Прайсы</a></li>
        <li><a href="{{ url('certificates') }}">Сертификаты</a></li>
        <li><a href="{{ url('contacts') }}">Контакты</a></li>
    </ul>


    <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav">
            <li><a href="#">Поиск</a></li>
        </ul>
    </div>
</nav>