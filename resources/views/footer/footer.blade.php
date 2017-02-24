<nav class="krep-navbar uk-navbar uk-margin-bottom">

    <ul class="uk-navbar-nav">
        <li><a href="/">Крепежные материалы</a></li>
        <li><a href="{{ url('catalog') }}">Каталог</a></li>
        <li><a href="{{ url('prices') }}">Прайсы</a></li>
        <li><a href="{{ url('certificates') }}">Сертификаты</a></li>
        <li><a href="{{ url('contacts') }}">Контакты</a></li>
    </ul>

</nav>

<div class="krep-navbar uk-navbar uk-margin-bottom uk-text-center copyright">
    &copy; {{ \Carbon\Carbon::now()->format('Y') }} <a href="https://vk.com/skiphog" target="_blank" rel="nofollow">Разработка и техническая поддержка skiphog</a>
</div>