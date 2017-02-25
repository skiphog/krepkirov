@extends('layouts.master_admin')

@section('title','Заказы')

@section('content')

    <h1 class="content uk-text-center">Заказы</h1>

    @if($orders->isNotEmpty())
        <div class="content uk-margin-bottom">
            <table id="order" class="uk-table uk-table-middle uk-table-hover">
                <thead>
                <tr>
                    <th class="uk-text-center"><i class="uk-icon-eye"></i></th>
                    <th class="uk-text-center">№</th>
                    <th class="uk-text-center">Статус</th>
                    <th class="uk-text-center">Организация</th>
                    <th class="uk-text-center">Имя</th>
                    <th class="uk-text-right">Сумма</th>
                    <th class="uk-text-right">Вес кг</th>
                    <th class="uk-text-center">Позиции</th>
                    <th class="uk-text-right">Дата создания</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="uk-text-center">
                            <a data-id="{{ $order->id }}" class="uk-icon-hover uk-icon-eye show"></a>
                        </td>
                        <td class="uk-text-center">{{ $order->id }}</td>
                        <td data-order="{{ $order->id }}" class="uk-text-center">{!! config('s.status_order.icon')[$order->status] !!}</td>
                        <td class="uk-text-center">{{ $order->organization }}</td>
                        <td class="uk-text-center">{{ $order->name }}</td>
                        <td class="uk-text-right">{{ number_format((float)$order->sum, 2,',',' ') }}</td>
                        <td class="uk-text-right">{{ number_format((float)$order->weight,2,',',' ') }}</td>
                        <td class="uk-text-center">{{ $order->positions }}</td>
                        <td class="uk-text-right">{{ $order->created_at->format('d-m-Y H:s') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $orders->links('partials.paginate') }}

    @endif
@endsection

@section('modal')
    @include('admin.orders.modal')
@endsection

@push('scripts')
    @include('admin.orders.script')
@endpush