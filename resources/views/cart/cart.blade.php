@extends('layouts.master')

@section('title','Оформление заказа')
@section('description','Оформление заказа')

@section('content')
    <h1 class="uk-text-center content">Оформление заказа</h1>

    <div class="content uk-margin-bottom">
        <div class="uk-alert uk-alert-warning">
            <p class="uk-text-center">
                <i class="uk-icon-info-circle"></i> Заказ формируется по розничным ценам. Окончательную сумму и цены вы увидите в счете после обработки заказа.
                <br>
                По всем интересующим вопросам звоните <a href="tel:+78332267872">+7 (8332) 26-78-72</a>
            </p>
        </div>
    </div>

    <div class="content uk-margin-bottom">
        @if(!empty($cart))

            <div class="content uk-overflow-container uk-form">
                <table id="cart" class="uk-table uk-table-middle">
                    <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>Кол-во</th>
                        <th>Вес</th>
                        <th>Цена</th>
                        <th>Итого</th>
                        <th>
                            <span class="uk-close"></span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach((array)$cart as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <input data-id="{{ $item['id'] }}" class="krep-input change-cart" type="number" value="{{ $item['qty'] }}" placeholder="0">
                            </td>
                            <td>{{ number_format((float)$item['weight'], 2, ',', ' ') }} кг</td>
                            <td>{{ number_format((float)$item['price_1'], 2, ',', ' ') }} р.</td>
                            <td>{{ number_format((float)$item['total_sum'], 2, ',', ' ') }} р.</td>
                            <td>
                                <a data-id="{{ $item['id'] }}" class="uk-close uk-close-alt del-cart"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table class="uk-table uk-table-middle uk-text-right">
                    <tr>
                        <td>Вес заказа:</td>
                        <td class="uk-text-bold">
                            <span id="total-weight">{{ number_format((float)array_sum(array_column($cart,'weight')), 2, ',', ' ') }}</span>
                            кг.
                        </td>
                    </tr>
                    <tr>
                        <td>Итого:</td>
                        <td class="uk-text-bold">
                            <span id="total-cart">{{ number_format((float)array_sum(array_column($cart,'total_sum')), 2, ',', ' ') }}</span>
                            р.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button class="uk-button uk-button-danger" onclick="clearCart()">@lang('ru.cart.button.remove')</button>
                        </td>
                    </tr>
                </table>

                <div class="uk-container">
                    @include('errors.list')
                    {{ Form::open(['action' => 'OrderController@store','class' => 'uk-form uk-form-stacked content uk-padding uk-margin-bottom']) }}
                    <fieldset>
                        <legend>Информация о заказчике</legend>
                        <div class="uk-form-row">
                            {!! Form::label('organization', 'Организация', ['class' => 'uk-form-label',
                                'title' => trans('ru.order.form.organization'),
                                'data-uk-toolti' => '{pos:\'left\'}'
                            ]) !!}
                            {!! Form::text('organization',null,['class' => 'uk-form-width-large','placeholder' => 'ИП / ООО / Частное лицо']) !!}
                        </div>

                        <div class="uk-form-row">
                            {!! Form::label('name', 'Имя', ['class' => 'uk-form-label input-required',
                                'title' => trans('ru.order.form.name'),
                                'data-uk-toolti' => '{pos:\'left\'}'
                            ]) !!}
                            {!! Form::text('name',null,['class' => 'uk-form-width-medium','placeholder' => 'Барак Обама','required']) !!}
                        </div>

                        <div class="uk-form-row">
                            {!! Form::label('phone', 'Телефон', ['class' => 'uk-form-label input-required',
                                'title' => trans('ru.order.form.phone'),
                                'data-uk-toolti' => '{pos:\'left\'}'
                            ]) !!}
                            {!! Form::text('phone',null,['class' => 'uk-form-width-medium e-mask','placeholder' => '+7 (999) 999-99-99','required']) !!}
                        </div>

                        <div class="uk-form-row">
                            {!! Form::label('email', 'e-mail', ['class' => 'uk-form-label',
                                'title' => trans('ru.order.form.email'),
                                'data-uk-toolti' => '{pos:\'left\'}'
                            ]) !!}
                            {!! Form::email('email',null,['class' => 'uk-form-width-medium','placeholder' => 'barak@obama.ru']) !!}
                        </div>

                        <div class="uk-form-row">
                            {!! Form::label('note', 'Примечание', ['class' => 'uk-form-label',
                                'title' => trans('ru.order.form.note'),
                                'data-uk-toolti' => '{pos:\'left\'}'
                            ]) !!}
                            {!! Form::textarea('note',null,['class' => 'uk-margin-bottom','rows' => 4,'placeholder' => '']) !!}
                        </div>

                        <div class="uk-form-row">
                            <label>
                                {!! Form::checkbox('policy', 1, false, ['required']) !!}
                                Я согласен <a href="{{ url('policy') }}">на обработку моих персональных данных</a>
                            </label>
                        </div>
                        <div class="uk-form-row">
                            {!! Form::button(trans('ru.cart.button.execute'),['type' => 'submit', 'class' => 'uk-button uk-button-success']) !!}
                        </div>
                    </fieldset>
                    {{ Form::close() }}
                </div>


            </div>
        @else
            <div class="uk-alert-primary uk-text-center" uk-alert>

                @if(session('status'))
                    <p class="uk-text-large">{{ session('status.lead') }}</p>
                    <p>{{ session('status.text') }}</p>
                @else
                    <p class="uk-text-large">@lang('ru.cart.empty')</p>
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
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}})
    var time, tw = $('#total-weight'), tc = $('#total-cart'), crt = $('#cart')
    crt.on('input propertyChange', '.change-cart', function () {
      var i = $(this)
      clearTimeout(time)
      time = setTimeout(function () {
        var id = i.data('id') * 1
        if (isNaN(id) || id === 0 || id === '') {
          return
        }
        var qtw = i.val() * 1
        if (isNaN(qtw)) {
          return
        }
        changeCarts(id, qtw, i)
      }, 500)
    })

    crt.on('click', '.del-cart', function () {
      var b = $(this)
      var id = b.data('id') * 1
      if (isNaN(id) || id === 0 || id === '') {
        return
      }
      changeCarts(id, 0, b)
      b.parent().parent().fadeOut()
    })

    function changeCarts (id, qtw, i) {
      $.ajax({
        url: '/cart/change',
        type: 'post',
        dataType: 'json',
        data: {id: id, qtw: qtw},
        success: function (json) {
          if (json['status'] === 1) {
            i.parent().next().html(json['small_weight'] + ' кг').next().next().html(json['sum'] + ' р')
          } else {
            i.parent().next().html('0 кг').next().next().html('0 р')
          }
          tw.text(json['weight'])
          tc.text(json['total'])
          if (json['count'] === 0) {
            //todo: Убрать кнопку оформление заказа
          }
        },
        error: function () {

        }
      })
    }
  })

  $('.e-mask').mask('+7 (999) 999-99-99')

</script>
@endpush