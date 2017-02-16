@extends('layouts.master')

@section('title','Прайс листы Крепежные материалы')
@section('description','Скачать прайс листы Крепежные материалы')

@section('content')

    <h1 class="uk-text-center content">Скачать прайс листы</h1>

    <div class="content uk-margin-bottom">
        @if(!$prices->isEmpty())
            <table class="uk-table uk-table-middle">
                <caption>Цены действительны на <span class="uk-text-bold">{{ \Carbon\Carbon::now()->addDays(-1)->format('d-m-Y') }}</span></caption>
                @foreach($prices as $price)
                    <tr>
                        <td class="uk-width-1-6"><a href="{{ $price->url }}"><i class="uk-icon-file-excel-o"></i> {{ $price->name }}</a></td>
                        <td class="uk-width-4-6">{{ $price->description }}</td>
                        <td class="uk-width-1-6">{{ $price->size }} Мб</td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Нет прайсов для скачивания</p>
        @endif
    </div>


@endsection