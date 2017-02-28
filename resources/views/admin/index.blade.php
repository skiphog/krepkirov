@extends('layouts.master_admin')

@section('title','Админка')

@section('content')

    <div class="uk-grid uk-grid-small uk-margin-bottom">
        <div class="uk-width-medium-1-2">
            <div class="content">
                <h3>Категорий всего: <strong>{{ $c_count }}</strong></h3>
                <table class="uk-table uk-table-middle content">
                    <caption>Последние пять созданные</caption>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <img width="50" src="/images/{{ $category->img }}" alt="{{ $category->title }}">
                            </td>
                            <td><a href="{{ route('categories.edit',['id' => $category->id]) }}" class="show-product">{{ $category->title }}</a></td>
                        </tr>
                    @endforeach
                </table>
                <div class="uk-text-center uk-margin-bottom">
                    <a href="{{ route('categories.index') }}">Перейти в категории</a>
                </div>
            </div>
        </div>

        <div class="uk-width-medium-1-2">
            <div class="content">
                <h3>Товаров всего: <strong>{{ $p_count }}</strong> Без категорий: <strong class="uk-text-danger">{{ $p_count_null }}</strong></h3>
                <table class="uk-table uk-table-middle content">
                    <caption>Последние пять загруженные</caption>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <img src="{{ !empty($product->image) ? '/images/catalog/' . $product->image . '.jpg': '/images/' . config('s.default_img_product') }}" alt="image" width="33">
                            </td>
                            <td>
                                <i class="{{ $product->category_id ? 'uk-icon-check-square uk-text-success' : 'uk-icon-external-link-square uk-text-danger' }}"></i>
                                <a class="show-product" href="{{ action('Admin\ProductController@edit',['$product' => $product->id]) }}">{{ $product->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="uk-text-center uk-margin-bottom">
                    <a href="{{ action('Admin\ProductController@index') }}">Перейти к товарам</a>
                </div>
            </div>
        </div>

    </div>

    <div class="uk-grid uk-grid-small uk-margin-bottom">

        <div class="uk-width-medium-1-2">
            <div class="content">
                <h3>Прайсов всего: <strong>{{ $c_prices }}</strong></h3>
                <table class=" content uk-table uk-table-middle">
                    <caption>Время последней загрузки</caption>
                    @foreach($prices as $price)
                        <tr>
                            <td><a href="{{ $price->url }}">{{ $price->name }}</a></td>
                            <td>{{ $price->m_date->format('d-m-Y H:i') }} <span class="uk-text-muted uk-text-small">{{ $price->m_date->diffForHumans() }}</span></td>
                            <td>{{ $price->size }} Мб</td>
                        </tr>
                    @endforeach
                </table>
                <div class="uk-text-center uk-margin-bottom">
                    <a href="{{ action('Admin\PriceController@index') }}">Перейти к прайсам</a>
                </div>
            </div>
        </div>

        <div class="uk-width-medium-1-2">
            <div class="content">
                <h3>Заказов всего: <strong>{{ $o_count }}</strong></h3>
                <table id="order" class="content uk-table uk-table-middle">
                    <caption>Последние заказы</caption>
                    @foreach($orders as $order)
                        <tr>
                            <td class="uk-text-center">{{ $order->id }}</td>
                            <td data-order="{{ $order->id }}" class="uk-text-center">{!! config('s.status_order.icon')[$order->status] !!}</td>
                            <td class="uk-text-center">
                                <a data-id="{{ $order->id }}" class="show-product show">{{ $order->name }}</a>
                            </td>
                            <td class="uk-text-right">{{ $order->created_at->format('d-m-Y H:s') }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="uk-text-center uk-margin-bottom">
                    <a href="{{ action('Admin\OrdersController@index') }}">Перейти к заказам</a>
                </div>
            </div>
        </div>

    </div>



    <div class="content uk-margin-bottom">
        <button id="make-xml" class="uk-button uk-button-primary">Сгенерировать SiteMap</button>
        - нужно для поисковиков. Делать после создания или изменения категорий.
    </div>

@endsection

@section('modal')
    @include('admin.orders.modal')
@endsection

@push('scripts')
<script>
    $('#make-xml').on('click',function () {
        getAjax('/admin/makeSiteMap', 'get', 'json', function (j) {
            if(j['status'] === 1) {
                UIkit.notify('<i class="uk-icon-check"></i> SiteMap сгенерирован', {pos:'top-center',status:'success'});
            }
        });
    });
</script>
@include('admin.orders.script')
@endpush