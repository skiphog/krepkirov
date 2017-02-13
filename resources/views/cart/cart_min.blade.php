<div id="cart-total" class="content uk-margin-bottom cart-mini" @if(empty(session('cart')) || request()->route()->uri === 'cart/show') style="display:none" @endif>

    <div class="uk-grid uk-flex-middle" data-uk-grid-margin>
        <div class="uk-width-medium-2-3">
            <p class="uk-text-bold uk-flex">
                <span class="uk-text-primary"><a href="{{ action('CartController@show') }}">Ваш заказаз на сумму</a></span>
                <span id="total" class="uk-margin-small-left">{{ number_format((float)session('total'), 2, ',', ' ') }}</span> руб. <i class="uk-icon-balance-scale uk-margin-left"></i>
                <span>{{ number_format((float)session('weight'), 2, ',', ' ') }}</span> кг
            </p>
        </div>

        <div class="uk-width-medium-1-3">
            <p>
                <a href="{{ action('CartController@show') }}" class="uk-button uk-button-success uk-button-large">@lang('ru.cart.button.execute')</a>
                <button class="uk-button uk-button-large" onclick="clearCart()">@lang('ru.cart.button.remove')</button>
            </p>
        </div>
    </div>
    <form id="clear-cart" action="{{ action('CartController@clear') }}" method="post" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>