@extends('layouts.master')

@section('title',$category->title)
@section('description',$category->description)

@section('content')

    <div class="uk-grid-small" uk-grid>

        <div class="uk-width-1-4@m uk-visible@m">
            <div class="uk-card uk-card-default uk-card-body">
                <ul class="uk-nav uk-nav-default">
                    <li class="uk-nav-header"><a href="{{ url('catalog') }}">Каталог</a></li>
                    @foreach($menus as $menu)
                        <li @if($category->id === $menu['id']) class="uk-active" @endif>
                            <a href="{{ url('catalog/' . $menu['full_url']) }}">{{ $menu['nav_title'] }}</a>
                            @if(!empty($menu['children']) && strpos($category->full_url,$menu['full_url']) === 0)
                                <ul class="uk-nav-sub">
                                    @foreach($menu['children'] as $child)
                                        @include('menu.cat_menu',['menu' => $child])
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="uk-width-3-4@m">
            <ul class="uk-breadcrumb uk-box-shadow-medium">
                <li>
                    <a href="{{ url('catalog') }}">Каталог</a>
                </li>
                @foreach($category->breadcrumbs as $breadcrumb)
                    <li>
                        <a href="{{ url('catalog/' . $breadcrumb['url']) }}">{{ $breadcrumb['title'] }}</a>
                    </li>
                @endforeach
                <li>
                    <span>{{ $category->title }}</span>
                </li>
            </ul>

            <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding-small">

                <div class="uk-flex-center uk-text-center" uk-grid>
                    <div class="uk-width-1-3@m">
                        <img src="{{ asset('images/' . $category->img) }}" alt="{{ $category->title }}">
                    </div>
                    <div class="uk-width-2-3@m">
                        <h1>{{ $category->title }}</h1>
                        {!! $category->text !!}
                    </div>
                </div>
            </div>

            <hr class="uk-divider-icon">

            @unless($categories->isEmpty())
                <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding-small">
                    <div class="uk-grid-match uk-grid-small uk-child-width-1-4@s uk-flex-center uk-text-center" uk-grid>
                        @foreach($categories as $category)
                            <div>
                                <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-hover">
                                    <a class="uk-link-reset" href="{{ url('catalog/' . $category->full_url) }}">
                                        <img src="{{ asset('images/' . $category->img) }}" alt="{{ $category->title }}">
                                        <br>
                                        {{ $category->title }}
                                        @unless(empty($category->standard))
                                            <p class="uk-text-bold">{{ $category->standard }}</p>
                                        @endunless
                                        @unless(empty($category->additionally))
                                            <p class="uk-text-muted">{{ $category->additionally }}</p>
                                        @endunless
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endunless

            @unless($products->isEmpty())
                <div id="product" class="content uk-box-shadow-medium uk-margin-bottom uk-padding-small">

                    @foreach($products as $product)
                        <div class="content uk-box-shadow-medium uk-margin-small-bottom uk-padding-xmall uk-grid-collapse uk-flex-middle" uk-grid>
                            <div class="uk-width-1-6@s">
                                <img src="/images/no_image.jpg" alt="{{ $product->name }}" width="70">
                            </div>
                            <div class="uk-width-1-3@s">
                                {{ $product->name }}
                            </div>
                            <div class="uk-width-1-4@s">
                                {{ number_format((float)$product->price_1,2,',',' ') }} р. {{ $product->unit }}
                            </div>
                            <div class="uk-width-1-4@s">
                                @if(session()->has('cart.' . $product->id))
                                    <input class="uk-input uk-form-width-small input-cart" type="number" value="{{ session()->get('cart.' . $product->id .'.qty') }}" placeholder="0">
                                    <a data-id="{{ $product->id }}" href="#" class="change-cart uk-icon-button uk-margin-left cart-added" uk-icon="icon: cart" title="Заказать"></a>
                                    <div>{{ number_format((float)session('cart.' . $product->id . '.sum'),2,',',' ') }} р. - {{ number_format((float)session('cart.' . $product->id . '.weight'),2,',',' ') }} кг</div>
                                @else
                                    <input class="uk-input uk-form-width-small input-cart" type="number" value="" placeholder="0">
                                    <a data-id="{{ $product->id }}" href="#" class="change-cart uk-icon-button uk-margin-left" uk-icon="icon: cart" title="Заказать"></a>
                                    <div></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endunless

        </div>
    </div>
@endsection

@push('scripts')
<Script>
    $(document).ready(function () {

        var total = $('#total'), ct = $('#cart-total');

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});

        $('#product').on('keydown','.input-cart',function (e) {
            if(e.keyCode === 13) {
                $(this).next().click().parent().parent().next().find('input').focus();
            }
        });


        $('.change-cart').on('click', function (e) {
            e.preventDefault();
            var a = $(this);

            var id = a.data('id') * 1;
            if(isNaN(id) || id === 0 || id === '') {
                return;
            }

            var qtw = a.prev('input').val() * 1;
            if(isNaN(qtw)) {
                return;
            }

            a.addClass('uk-animation-scale-down');

            $.ajax({
                url: '/cart/change',
                type: 'post',
                dataType:'json',
                data:{id:id,qtw:qtw},
                success: function (json) {

                    if(json['status'] === 1) {
                        a.addClass('cart-added');
                        a.next('div').html('' + json['sum'] + ' р. - ' + json['small_weight'] + ' кг');

                    }else{
                        a.removeClass('cart-added');
                        a.next('div').html('');
                    }

                    if(json['count'] === 0) {
                        ct.hide();
                    }else {
                        ct.show();
                    }

                    total.html(json['total']).next().next().html(json['weight']);

                    setTimeout(function () {
                        a.removeClass('uk-animation-scale-down');
                    },500)
                },
                error:function () {
                    a.removeClass('cart-added');
                    a.prev('input').val(0);

                }
            });


        })
    });
</Script>
@endpush
