@extends('layouts.master_admin')

@section('title','Заказы')

@section('content')

    <h1 class="content uk-text-center">Заказы</h1>

    @if($orders->isNotEmpty())
        <div class="content uk-margin-bottom">
            <table class="uk-table uk-table-middle uk-table-hover">
                <thead>
                    <tr>
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
                       <td class="uk-text-center">{{ $order->id }}</td>
                       <td class="uk-text-center"><i class="{{ $order->status ? 'uk-icon-upload uk-text-success' : 'uk-icon-spinner uk-icon-spin uk-text-warning' }}"></i></td>
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

@push('scripts')

<script>

    $(document).ready(function () {

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});



    });
</script>
@endpush