@extends('layouts.master')

@section('title','Крепежные материалы г. Киров - Оптовая и розничная продажа крепежа.')
@section('description','Купить крепеж оптом! Болты, гвозди, гайки, шайбы, саморезы и многое другое в широком ассортименте.')

@section('content')


    <h1 class="uk-text-center content">Ищете крепеж по оптовым ценам в Кирове?</h1>

    <div class="content uk-text-center uk-margin-bottom">
        <p class="uk-text-large">ООО «Крепежные материалы» г. Киров</p>
        <p class="uk-text-large">Вы всегда найдете крепеж у нас в ассортименте</p>

        <!-- Тут какая нить фигня -->

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

    <div class="uk-grid uk-margin-bottom" data-uk-grid-margin>
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

    <div class="uk-grid uk-margin-bottom" data-uk-grid-margin>
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

    <div class="uk-grid uk-margin-bottom" data-uk-grid-margin>
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