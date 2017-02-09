@extends('layouts.master')

@section('title','Оформление заказа')
@section('description','Оформление заказа')

@section('content')
    <h1 class="uk-text-center content uk-box-shadow-medium">Оформление заказа</h1>
    <hr class="uk-divider-icon">

    <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding-small">
    @if(!empty(session('cart')))

    <div class="uk-overflow-auto uk-box-shadow-medium">
        <table id="cart" class="cart-table uk-table uk-table-middle">
            <thead>
                <tr>
                    <th class="uk-table-expand">Наименование</th>
                    <th>Кол-во</th>
                    <th>Вес</th>
                    <th>Цена</th>
                    <th>Итого</th>
                    <th><span uk-icon="icon: close"></span></th>
                </tr>
            </thead>
            <tbody>
            @foreach(session('cart') as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td><input data-id="{{ $id }}" class="uk-input uk-form-width-small input-cart change-cart" type="number" value="{{ $item['qty'] }}" placeholder="0"> {{ $item['unit'] }}</td>
                    <td>{{ number_format((float)$item['weight'], 2, ',', ' ') }} кг</td>
                    <td>{{ number_format((float)$item['price'], 2, ',', ' ') }} р.</td>
                    <td>{{ number_format((float)$item['sum'], 2, ',', ' ') }} р.</td>
                    <td><button data-id="{{ $id }}" class="del-cart" type="button" uk-close></button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="cart-table uk-table uk-table-middle uk-text-right">
            <tr>
                <td class="uk-table-expand">Вес заказа:</td>
                <td class="uk-text-bold"><span id="total-weight">{{ number_format((float)session('weight'), 2, ',', ' ') }}</span> кг.</td>
            </tr>
            <tr>
                <td>Итого:</td>
                <td class="uk-text-bold"><span id="total-cart">{{ number_format((float)session('total'), 2, ',', ' ') }}</span> р.</td>
            </tr>
        </table>
    </div>
    @else
        <p>Заказа нет</p>
    @endif

    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
        var time,tw = $('#total-weight'),tc = $('#total-cart'),crt = $('#cart');
        crt.on('input propertyChange','.change-cart',function () {
            var i = $(this);
            clearTimeout(time);
            time = setTimeout(function () {
                var id = i.data('id') * 1;
                if(isNaN(id) || id === 0 || id === '') {
                    return;
                }
                var qtw = i.val() * 1;
                if(isNaN(qtw)) {
                    return;
                }
                changeCarts(id,qtw,i);
            },500);
        });

        crt.on('click','.del-cart',function () {
            var b = $(this);
            var id = b.data('id') * 1;
            if(isNaN(id) || id === 0 || id === '') {
                return;
            }
            changeCarts(id,0,b);
            b.parent().parent().fadeOut();
        });



        function changeCarts(id, qtw, i) {
            $.ajax({
                url: '/cart/change',
                type: 'post',
                dataType:'json',
                data:{id:id,qtw:qtw},
                success: function (json) {
                    if(json['status'] === 1) {
                        i.parent().next().html(json['small_weight'] + ' кг').next().next().html(json['sum'] + ' р');
                    }else{
                        i.parent().next().html('0 кг').next().next().html('0 р');
                    }
                    tw.text(json['weight']);
                    tc.text(json['total']);
                    if(json['count'] === 0) {
                        //todo: Убрать кнопку оформление заказа
                    }
                },
                error:function () {

                }
            });
        }
    });

</script>
@endpush