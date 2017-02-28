@extends('layouts.master')

@section('title',$category->title)
@section('description',$category->description)

@section('content')

    <div class="uk-grid uk-grid-small">

        <div class="uk-width-medium-1-5 uk-hidden-small">

            <div class="content">

                <ul class="uk-nav">
                    <li>
                        <a href="{{ url('catalog') }}">Каталог</a>
                        <ul class="uk-nav-sub">
                            @foreach($menus as $menu)
                                @include('menu.cat_menu',['menu' => $menu])
                            @endforeach
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

        <div class="uk-width-medium-4-5">
            <ul class="uk-breadcrumb content">
                <li><a href="{{ url('catalog') }}">Каталог</a></li>
                @foreach($category->breadcrumbs as $breadcrumb)
                    <li><a href="{{ url('catalog/' . $breadcrumb['url']) }}">{{ $breadcrumb['title'] }}</a></li>
                @endforeach
                <li class="uk-active"><span>{{ $category->title }}</span></li>
            </ul>

            <div class="content uk-margin-bottom">

                <div class="uk-grid uk-flex-middle">
                    <div class="uk-width-medium-1-5">
                        <img src="{{ asset('images/' . $category->img) }}" alt="{{ $category->title }}" width="150" height="100">
                    </div>

                    <div class="uk-width-medium-4-5">
                        <h1>{{ $category->title }}</h1>
                        @if(!empty($category->standard))
                            <p class="krep-standard">{{ $category->standard }}</p>
                        @endif
                        @if(!empty($category->additionally))
                            <p class="krep-additionally">{{ $category->additionally }}</p>
                        @endif
                        <div class="krep-description">{!! $category->text !!}</div>
                    </div>
                </div>

            </div>

            @if(!$categories->isEmpty())
                <div class="content uk-margin-bottom uk-padding">
                    @foreach($categories as $category)

                        <a class="uk-thumbnail cart-category krep-cart-product" href="/catalog/{{ $category->full_url }}">
                            <img src="/images/{{ $category->img }}" alt="{{ $category->title }}" width="150" height="100">
                            <div class="uk-thumbnail-caption">
                                {{ $category->title }}
                                @if(!empty($category->standard))
                                    <p class="uk-text-bold">{{ $category->standard }}</p>
                                @endif
                                @if(!empty($category->additionally))
                                    <p class="uk-text-muted">{{ $category->additionally }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            @if(!$products->isEmpty())


                <div id="change-price" class="uk-margin-bottom uk-form uk-clearfix" data-uk-sticky="{top:10}">
                    <div class="content uk-float-right uk-margin-large-right" data-uk-button-radio>
                        <i class="uk-icon-question-circle uk-icon-small uk-margin-right uk-margin-left" data-uk-tooltip="{pos:'bottom'}" title="Тип цены зависит от объема закупки, формы оплаты и сложности комплектации"></i>
                        <button class="b-price uk-button uk-active" value="0">розница</button>
                        <button class="b-price uk-button" value="1">мелкий опт</button>
                        <button class="b-price uk-button" value="2">опт</button>
                    </div>
                </div>



                <div id="product" class="content uk-margin-bottom uk-form">

                    @foreach($products as $product)
                        <div class="content uk-margin-small-bottom uk-grid uk-grid-collapse uk-flex-middle">

                            @if(!empty($product->image))
                                <div class="uk-width-medium-1-6">
                                    <img class="show-img" src="/images/catalog/{{ $product->image . '.jpg' }}" alt="{{ $product->name }}" width="70">
                                </div>

                                <div class="uk-width-medium-3-6">
                                    <a class="show-product" href="#" data-img="/images/catalog/{{ $product->image . '_400.jpg' }}">{{ $product->name }}</a>
                                    <div class="prod-description">{!! $product->description !!}</div>
                                </div>
                            @else
                                <div class="uk-width-medium-1-6">
                                    <img class="show-img" src="/images/{{ $category->img }}" alt="{{ $product->name }}" width="70">
                                </div>

                                <div class="uk-width-medium-3-6">
                                    <a class="show-product" href="#" data-img="/images/{{ $category->img }}">{{ $product->name }}</a>
                                    <div class="prod-description">{!! $product->description !!}</div>
                                </div>
                            @endif

                            <div class="uk-width-medium-1-6">
                                <strong data-prices="{{ number_format((float)$product->price_1,2,',',' ') }}-{{ number_format((float)$product->price_2,2,',',' ') }}-{{ number_format((float)$product->price_3,2,',',' ') }}">
                                    {{ number_format((float)$product->price_1,2,',',' ') }}
                                </strong> р. {{ $product->unit }}
                            </div>
                            <div class="uk-width-medium-1-6">
                                @if(session()->has('cart.' . $product->id))
                                    <input class="input-cart krep-input" type="number" value="{{ session()->get('cart.' . $product->id .'.qty') }}" placeholder="0">
                                    <a data-id="{{ $product->id }}" href="#" class="change-cart uk-icon-button uk-icon-shopping-basket cart-added" title="Заказать"></a>
                                    <div>{{ number_format((float)session('cart.' . $product->id . '.sum'),2,',',' ') }} р. - {{ number_format((float)session('cart.' . $product->id . '.weight'),2,',',' ') }} кг</div>
                                @else
                                    <input class="input-cart krep-input" type="number" value="" placeholder="0">
                                    <a data-id="{{ $product->id }}" href="#" class="change-cart uk-icon-button uk-icon-shopping-basket" title="Заказать"></a>
                                    <div></div>
                                @endif
                            </div>
                        </div>

                    @endforeach
                </div>
            @endif

        </div>
    </div>
@endsection

@section('modal')
    <div id="modal-product" class="uk-modal">
        <div class="uk-modal-dialog uk-text-center">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header"></div>
            <img src="/images/no_image_400.jpg" alt="no image">
            <div class="uk-modal-footer uk-text-left"></div>
        </div>
    </div>
@endsection

@push('scripts')
<Script>
    $(document).ready(function () {

        var total = $('#total'), ct = $('#cart-total'), ps = $('#product');

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});

        ps.on('keydown','.input-cart',function (e) {
            if(e.keyCode === 13) {
                $(this).next().click().parent().parent().next().find('input').focus();
            }
        });

        var modal = UIkit.modal('#modal-product',{center:true});

        ps.on('click','.show-product', function (e) {
            e.preventDefault();
            var a = $(this);
            console.log(a.data('img'),a.next().html());
            modal.find('.uk-modal-header').html('<h2>' + a.html() + '</h2>')
                .next('img').attr('src',a.data('img'))
                .next('div').html(a.next().html());
            modal.show();
        });

        ps.on('click','.show-img', function () {
            $(this).parent().next().find('.show-product').click();
        });

        var p = ps.find('[data-prices]');

        $('#change-price').on('click','.b-price',function () {
            changePrice($(this).val());
        });

        function changePrice(i) {
            p.each(function (k, v) {
                v.innerHTML = v.dataset.prices.split('-')[i];
            });
        }


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
