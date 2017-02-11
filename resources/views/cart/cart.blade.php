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
                        <th>
                            <span uk-icon="icon: close"></span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach((array)session('cart') as $id => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <input data-id="{{ $id }}" class="uk-input uk-form-width-small input-cart change-cart" type="number" value="{{ $item['qty'] }}" placeholder="0"> {{ $item['unit'] }}
                            </td>
                            <td>{{ number_format((float)$item['weight'], 2, ',', ' ') }} кг</td>
                            <td>{{ number_format((float)$item['price'], 2, ',', ' ') }} р.</td>
                            <td>{{ number_format((float)$item['sum'], 2, ',', ' ') }} р.</td>
                            <td>
                                <button data-id="{{ $id }}" class="del-cart" type="button" uk-close></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table class="cart-table uk-table uk-table-middle uk-text-right">
                    <tr>
                        <td class="uk-table-expand">Вес заказа:</td>
                        <td class="uk-text-bold">
                            <span id="total-weight">{{ number_format((float)session('weight'), 2, ',', ' ') }}</span>
                            кг.
                        </td>
                    </tr>
                    <tr>
                        <td>Итого:</td>
                        <td class="uk-text-bold">
                            <span id="total-cart">{{ number_format((float)session('total'), 2, ',', ' ') }}</span>
                            р.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><button class="uk-button uk-button-danger" onclick="clearCart()">@lang('ru.cart.button.remove')</button></td>
                    </tr>
                </table>

                <div class="uk-container uk-container-small">
                    @include('errors.list')
                    {{ Form::open(['action' => 'OrderController@store','class' => 'uk-form-stacked content uk-box-shadow-medium uk-padding uk-margin-bottom']) }}
                    <fieldset class="uk-fieldset">
                        <legend class="uk-legend">Информация о заказчике</legend>
                        <div class="uk-margin">
                            {!! Form::label('organization', 'Организация', ['class' => 'uk-form-label',
                                'title' => trans('ru.order.form.organization'),
                                'uk-tooltip' => 'pos: left'
                            ]) !!}
                            {!! Form::text('organization',null,['class' => 'uk-input','placeholder' => 'ИП / ООО / Частное лицо']) !!}
                        </div>

                        <div class="uk-margin">
                            {!! Form::label('name', 'Имя', ['class' => 'uk-form-label input-required',
                                'title' => trans('ru.order.form.name'),
                                'uk-tooltip' => 'pos: left'
                            ]) !!}
                            {!! Form::text('name',null,['class' => 'uk-input','placeholder' => 'Барак Обама','required']) !!}
                        </div>

                        <div class="uk-margin">
                            {!! Form::label('phone', 'Телефон', ['class' => 'uk-form-label input-required',
                                'title' => trans('ru.order.form.phone'),
                                'uk-tooltip' => 'pos: left'
                            ]) !!}
                            {!! Form::text('phone',null,['class' => 'uk-input e-mask','placeholder' => '+7 (999) 999-99-99','required']) !!}
                        </div>

                        <div class="uk-margin">
                            {!! Form::label('email', 'e-mail', ['class' => 'uk-form-label',
                                'title' => trans('ru.order.form.email'),
                                'uk-tooltip' => 'pos: left'
                            ]) !!}
                            {!! Form::email('email',null,['class' => 'uk-input','placeholder' => 'barak@obama.ru']) !!}
                        </div>

                        <div class="uk-margin">
                            {!! Form::label('note', 'Примечание', ['class' => 'uk-form-label',
                                'title' => trans('ru.order.form.note'),
                                'uk-tooltip' => 'pos: left'
                            ]) !!}
                            {!! Form::textarea('note',null,['class' => 'uk-textarea','rows' => 4,'placeholder' => '']) !!}
                        </div>

                        {!! Form::submit(trans('ru.cart.button.execute'),['class' => 'uk-button cart-added']) !!}

                    {{ Form::close() }}
                    </fieldset>
                </div>


            </div>
        @else
            <div class="uk-alert-primary uk-text-center" uk-alert>

                @if(session('status'))
                    <p class="uk-text-lead">{{ session('status.lead') }}</p>
                    <p>{{ session('status.text') }}</p>
                @else
                    <p class="uk-text-lead">@lang('ru.cart.empty')</p>
                @endif

                <p>
                    <a class="uk-button uk-button-primary" href="{{ url('catalog') }}">@lang('ru.order.move')</a>
                </p>

            </div>
        @endif

    </div>
@endsection

@push('scripts')
<script src="/js/jquery.maskedinput.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
        var time, tw = $('#total-weight'), tc = $('#total-cart'), crt = $('#cart');
        crt.on('input propertyChange', '.change-cart', function () {
            var i = $(this);
            clearTimeout(time);
            time = setTimeout(function () {
                var id = i.data('id') * 1;
                if (isNaN(id) || id === 0 || id === '') {
                    return;
                }
                var qtw = i.val() * 1;
                if (isNaN(qtw)) {
                    return;
                }
                changeCarts(id, qtw, i);
            }, 500);
        });

        crt.on('click', '.del-cart', function () {
            var b = $(this);
            var id = b.data('id') * 1;
            if (isNaN(id) || id === 0 || id === '') {
                return;
            }
            changeCarts(id, 0, b);
            b.parent().parent().fadeOut();
        });


        function changeCarts(id, qtw, i) {
            $.ajax({
                url: '/cart/change',
                type: 'post',
                dataType: 'json',
                data: {id: id, qtw: qtw},
                success: function (json) {
                    if (json['status'] === 1) {
                        i.parent().next().html(json['small_weight'] + ' кг').next().next().html(json['sum'] + ' р');
                    } else {
                        i.parent().next().html('0 кг').next().next().html('0 р');
                    }
                    tw.text(json['weight']);
                    tc.text(json['total']);
                    if (json['count'] === 0) {
                        //todo: Убрать кнопку оформление заказа
                    }
                },
                error: function () {

                }
            });
        }
    });

    $('.e-mask').mask('+7 (999) 999-99-99');

</script>
@endpush