@extends('layouts.master')

@section('title','Контакты')
@section('description','Контакты Крепежные материалы')

@section('css')
    <style>canvas{max-width:none}</style>
@endsection

@section('content')
    <h1 class="uk-text-center content">Контакты</h1>

    <div class="content uk-margin-bottom">

        <div class="uk-grid uk-grid-small uk-flex-middle">

            <div class="uk-width-1-5">
                <img class="shadow-box" src="/images/worker.jpg" width="200" height="269" alt="Крепежные материалы">
            </div>
            <div class="uk-width-4-5" itemscope itemtype="http://schema.org/LocalBusiness">
                <h3 itemprop="name">ООО &laquo;Крепежные материалы&raquo;</h3>
                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <p>
                        <span class="uk-hidden">Адрес</span><i class="uk-icon-small uk-icon-home"></i>
                        <span itemprop="postalCode">610025</span>,
                        г. <span itemprop="addressLocality">Киров</span>,
                        ул. <span itemprop="streetAddress">Мельничная, 1</span>
                    </p>
                    <p>
                        <span class="uk-hidden">Телефон</span><i class="uk-icon-small uk-icon-phone"></i>
                        <a href="tel:+78332267872" itemprop="telephone">+7 (8332) <strong>26-78-72</strong></a>,
                        <strong>46-08-49</strong>, (факс) <strong>60-25-86</strong>
                    </p>
                    <p>
                        <span class="uk-hidden">email</span><i class="uk-icon-small uk-icon-at"></i>
                        <a href="mailto:metiz@krepkirov.ru"><span itemprop="email">metiz@krepkirov.ru</span></a>
                    </p>
                </div>
                <p><strong>Режим работы: </strong>
                    <br>
                    <span itemprop="openingHours" datetime="Mo,Tu,We,Th,Fr 08:00-17:00">
                        Понедельник - Пятница с 08:00 до 17:00
                        <br>
                        Суббота с 09:00 до 13:00
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="content uk-margin-bottom">
        <div class="uk-grid uk-grid-small uk-text-center" data-uk-margin>
            <div class="uk-width-medium-1-2">
                <div id="map" class="shadow-box" style="width:100%; height:404px"></div>
            </div>
            
            <div class="uk-width-medium-1-2">
                <img class="shadow-box" src="/images/baza.jpg" width="538" height="404" alt="Baza">
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="//api-maps.yandex.ru/2.0/?load=package.standard,package.geoObjects&amp;lang=ru-RU" type="text/javascript"></script>
<script>ymaps.ready(init);function init(){var myMap=new ymaps.Map("map",{center: [58.578767,49.659545],zoom:16}),myPlacemark=new ymaps.Placemark([58.57756,49.662055],{balloonContentHeader:"Крепежные материалы",balloonContentBody:"г. Киров, ул. Мельничная, д. 1",balloonContentFooter:"(8332) 26-78-72, 46-08-49"},{iconImageHref:'/images/balon.png',iconImageSize:[37,42],iconImageOffset:[-10,-42]});myMap.controls.add('zoomControl',{left:5,top:5}).add('typeSelector').add('mapTools',{left:35,top:5});myMap.geoObjects.add(myPlacemark)}</script>
@endpush
