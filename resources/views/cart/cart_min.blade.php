<div id="cart-total" uk-alert @if(empty(session('cart')) || request()->route()->uri === 'cart/show') style="display:none" @endif>

    <div class="uk-grid-small uk-flex-middle" uk-grid>
        <div class="uk-width-2-3@s">
            <p class="uk-text-bold ">
                <span class="uk-text-primary"><a href="{{ action('CartController@show') }}">Ваш заказаз на сумму</a></span>
                <span id="total">{{ number_format((float)session('total'), 2, ',', ' ') }}</span> руб. <span class="uk-margin-left" uk-icon="icon: info"></span>
                <span>{{ number_format((float)session('weight'), 2, ',', ' ') }}</span> кг
            </p>
        </div>
        <div class="uk-width-1-3@s">
            <p uk-margin>
                <a href="{{ action('CartController@show') }}" class="uk-button cart-added">Оформить</a>
                <button class="uk-button uk-button-default" onclick="clearCart()">Удалить</button>
            </p>
        </div>
    </div>
    <form id="clear-cart" action="{{ action('CartController@clear') }}" method="post" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>