<a class="uk-modal-close uk-close"></a>

<ul class="uk-tab" data-uk-tab data-uk-switcher="{connect:'#switcher'}">
    <li class="uk-active"><a href="#">Информация о заказе</a></li>
    <li><a href="#">Заказанные товары</a></li>
</ul>

<div id="switcher" class="uk-switcher">

    <form id="order-form" data-uk-switcher-item="0" class="uk-form">
        <table class="uk-table uk-table-middle order-table">
            <tbody>
            <tr>
                <td class="uk-text-right uk-text-bold"><label for="status">Статус:</label></td>
                <td>
                    <select id="status" name="status" class="form-control">
                        @foreach((array)config('s.status_order.word') as $key => $item)
                            <option value="{{ $key }}" @if($key === $order->status) selected @endif>{{ $item }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td class="uk-text-right uk-text-bold">Организация:</td>
                <td>{{ $order->organization }}</td>
            </tr>
            <tr>
                <td class="uk-text-right uk-text-bold">Имя:</td>
                <td>{{ $order->name }}</td>
            </tr>
            <tr>
                <td class="uk-text-right uk-text-bold">Телефон:</td>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <td class="uk-text-right uk-text-bold">email:</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td class="uk-text-right uk-text-bold">Примечание:</td>
                <td>{{ $order->note }}</td>
            </tr>
            </tbody>
        </table>

        <p>
            Позиции: <strong>{{ $order->positions }}</strong>
            <br>
            Вес заказа: <strong>{{ number_format((float)$order->weight, 2,',',' ') }} кг</strong>
            <br>
            Сумма: <strong>{{ number_format((float)$order->sum, 2,',',' ') }} руб.</strong>
        </p>

        <button id="order-button" type="submit" class="uk-button uk-button-primary" style="display: none" value="{{ $order->id }}">Сохранить</button>

    </form>

    <div class="uk-clearfix" data-uk-switcher-item="1">

        <table class="uk-table uk-table-striped uk-table-middle uk-margin-bottom">
            <thead>
            <tr>
                <th class="uk-text-left"><i class="uk-icon-hashtag"></i></th>
                <th class="uk-text-center">Номенклатура</th>
                <th class="uk-text-right">Кол-во</th>
                <th class="uk-text-center">Ед.изм</th>
                <th class="uk-text-right">Цена</th>
                <th class="uk-text-right">Сумма</th>
            </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="uk-text-right">{{ $item->quantity }}</td>
                        <td class="uk-text-center">{{ $item->unit }}</td>
                        <td class="uk-text-right">{{ number_format((float)$item->price, 2,',',' ') }}</td>
                        <td class="uk-text-right">{{ number_format((float)$item->sum, 2,',',' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="uk-float-right">
            Вес заказа: <strong>{{ number_format((float)$order->weight, 2,',',' ') }} кг</strong>
            <br>
            Сумма: <strong>{{ number_format((float)$order->sum, 2,',',' ') }} руб.</strong>
        </p>


    </div>

</div>