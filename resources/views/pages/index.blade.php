@extends('layouts.master')

@section('title','Крепежные материалы г. Киров - Оптовая и розничная продажа крепежа.')
@section('description','Купить крепеж оптом! Болты, гвозди, гайки, шайбы, саморезы и многое другое в широком ассортименте.')
@section('css')
    <link rel="stylesheet" href="/css/slider.almost-flat.min.css">
    <link rel="stylesheet" href="/css/slidenav.almost-flat.min.css">
@endsection

@section('content')


    <h1 class="uk-text-center content">Ищете крепеж по оптовым ценам в Кирове?</h1>

    <div class="content uk-text-center uk-margin-bottom">
        <p class="uk-text-large">ООО «Крепежные материалы» г. Киров</p>
        <p class="uk-text-large">Вы всегда найдете крепеж у нас в ассортименте</p>
    </div>

    <div class="uk-text-center uk-margin-bottom uk-grid" data-uk-margin>
        <div class="uk-width-small-1-3">
            <figure class="uk-overlay uk-overlay-hover">
                <img class="shadow-box uk-overlay-spin" src="/images/baza/gvozdi.jpg" width="640" height="480" alt="Гвозди">
                <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                    <h3>Крепеж</h3>
                    <p>Анкеры, саморезы, метрический крепеж</p>
                </div>
                <a class="uk-position-cover" href="{{ url('catalog') }}"></a>
            </figure>
        </div>
        <div class="uk-width-small-1-3">
            <figure class="uk-overlay uk-overlay-hover">
                <img class="shadow-box uk-overlay-spin" src="/images/baza/l2.jpg" width="640" height="480" alt="Метизы">
                <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                    <h3>Фурнитура</h3>
                    <p>Мебельная и дверная</p>
                </div>
                <a class="uk-position-cover" href="{{ url('catalog/furnitura') }}"></a>
            </figure>
        </div>
        <div class="uk-width-small-1-3">
            <figure class="uk-overlay uk-overlay-hover">
                <img class="shadow-box uk-overlay-spin" src="/images/baza/instrum.jpg" width="640" height="480" alt="Инструмент">
                <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                    <h3>Инструмент</h3>
                    <p>От отвертки до бензопилы</p>
                </div>
                <a class="uk-position-cover" href="{{ url('catalog/instrument') }}"></a>
            </figure>
        </div>
    </div>

    <div class="content uk-margin-bottom">
        <div class="uk-slidenav-position" data-uk-slider="{autoplay: true,autoplayInterval:3000}">

            <div class="uk-slider-container">
                <ul class="uk-slider uk-grid uk-grid-width-small-1-4 uk-grid-width-medium-1-6 uk-grid-small" style="min-height:110px">

                    @foreach($categories as $category)
                        <li>
                            <a class="content" href="/catalog/{{ $category->full_url }}">
                                <img src="/images/{{  $category->img }}" alt="{{ $category->title }}">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous" draggable="false"></a>
            <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next" draggable="false"></a>

        </div>
    </div>

    <div class="content uk-text-center uk-margin-bottom">

        <p class="uk-text-large">Купить крепеж в Кирове - просто!</p>
        <p>
            <strong>Мы поможем сократить Вам денежные расходы и время!</strong>
            <br>
            Предлагаем строительный крепеж и инструмент от производителей и наших партнеров.
        </p>


        <div class="uk-grid uk-grid-collapse uk-margin-bottom">
            <div class="uk-width-1-4">
                <img class="shadow-box" src="/images/partners/tech-krep.jpg" width="180" height="65" alt="tech-krep">
            </div>
            <div class="uk-width-1-4">
                <img class="shadow-box" src="/images/partners/zitar.jpg" width="180" height="65" alt="tech-krep">
            </div>
            <div class="uk-width-1-4">
                <img class="shadow-box" src="/images/partners/stinger.jpg" width="180" height="65" alt="tech-krep">
            </div>
            <div class="uk-width-1-4">
                <img class="shadow-box" src="/images/partners/mtk.jpg" width="180" height="65" alt="tech-krep">
            </div>
        </div>
    </div>

    <div class="uk-grid uk-margin-small-bottom">
        <div class="uk-width-medium-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
            <div class="content carts">
                <h3><i class="uk-icon-search"></i> Вы найдете у нас именно то, что Вам нужно!</h3>
                <p>Наш ассортимент удовлетворяет практически любые запросы. <b>10 000</b> наименований позиций в прайсе соответствует наличию складским запасам на <b>98%</b>.</p>
            </div>
        </div>
        <div class="uk-width-medium-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-right'}">
            <div class="content carts">
                <h3><i class="uk-icon-balance-scale"></i> Удобная фасовка для магазинов, организаций!</h3>
                <p>От промкоробок и до любой, наиболее выгодной для Вас упаковки.</p>
            </div>
        </div>
    </div>

    <div class="uk-grid uk-margin-small-bottom uk-margin-top-remove">
        <div class="uk-width-medium-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
            <div class="content carts">
                <h3><i class="uk-icon-check"></i> Вам больше не нужно искать спец крепеж!</h3>
                <p>Доверьте это нам! Более <b>10</b>-ти лет опыта работы с крепежом позволяет эффективно ориентироваться на метизном рынке. Мы найдем для Вас любой крепеж и привезем его в течение недели.</p>
            </div>
        </div>
        <div class="uk-width-medium-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-right'}">
            <div class="content carts">
                <h3><i class="uk-icon-rub"></i> Вы можете рассчитывать на низкие цены!</h3>
                <p>Мы следим за тем, что бы наши цены оставались адекватными. Но! Даже если Вы нашли где-то дешевле, <b>ЗВОНИТЕ!</b> - договоримся...</p>
            </div>
        </div>
    </div>

    <div class="uk-grid uk-margin-small-bottom uk-margin-top-remove">
        <div class="uk-width-medium-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
            <div class="content carts">
                <h3><i class="uk-icon-clock-o"></i> Вы экономите не только деньги, но и время!</h3>
                <p>Моментальное обслуживание, начиная с выписки и оканчивая получением товара. Офис и склад находятся <b>в одном месте</b>.</p>
            </div>
        </div>
        <div class="uk-width-medium-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-right'}">
            <div class="content carts">
                <h3><i class="uk-icon-bus"></i> Вам не нужно беспокоиться о доставке!</h3>
                <p>Мы скомплектуем товар и доставим его до вашего склада в Кирове <b>Бесплатно!</b></p>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="/js/slider.min.js"></script>
@endpush