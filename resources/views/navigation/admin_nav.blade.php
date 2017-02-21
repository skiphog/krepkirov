<li class="uk-parent" data-uk-dropdown="{pos:'bottom-right'}">
    <a>{{ Auth::user()->name }}</a>
    <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-small">
        <ul class="uk-nav uk-nav-navbar">
            <li><a href="{{ route('categories.index') }}">Категории</a></li>
            <li><a href="{{ action('Admin\ProductController@index') }}">Товары</a></li>
            <li><a href="{{ action('Admin\PriceController@index') }}">Прайсы</a></li>
            <li><a href="{{ action('Admin\OrdersController@index') }}">Заказы</a></li>
            <li class="uk-nav-divider"></li>
            <li>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Выход
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="uk-hidden">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</li>