@extends('layouts.master')

@section('title','Страница не найдена')
@section('description','Ошибка 404')

@section('content')
    <div class="content uk-text-center uk-margin-bottom">
        <img src="/images/404.png" alt="404" width="348" height="266">
        <img src="/images/molotok.gif" width="108" height="100" alt="Молотчек">
        <p class="uk-text-large">Извините, мы переделали сайт и старые ссылки больше не работают.</p>
        <p class="uk-text-large">Попробуйте начать с <a href="/">главной</a> страницы или перейти в <a href="{{ url('catalog') }}">каталог</a>.</p>
    </div>
@endsection