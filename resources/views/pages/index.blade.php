@extends('layouts.master')

@section('title','Крепежные главная')
@section('description','Тут такое типа описание орололололо')

@section('content')


    <h1 class="uk-text-center content uk-box-shadow-medium">Ищете крепеж по оптовым ценам в Кирове?</h1>
    <hr class="uk-divider-icon">

    <div class="content uk-box-shadow-medium uk-margin-bottom">
        <div class="uk-text-center">
            <p class="uk-text-lead">ООО «Крепежные материалы» г. Киров</p>
            <p class="uk-text-lead">Вы всегда найдете крепеж у нас в ассортименте</p>
        </div>
    </div>

    <div class="content uk-box-shadow-medium uk-margin-bottom">
        <div class="uk-text-center">
            <p class="uk-text-lead">Купить крепеж в Кирове - просто!</p>
            <p>
                <strong>Мы поможем сократить Вам денежные расходы и время!</strong>
                <br>
                Предлагаем строительный крепеж и инструмент от производителей и наших партнеров.
            </p>
        </div>

        <div class="uk-padding uk-child-width-expand@s uk-text-center" uk-grid>

            <div>
                <img class="uk-box-shadow-medium" src="/images/partners/tech-krep.jpg" width="180" height="65" alt="tech-krep">
            </div>
            <div>
                <img class="uk-box-shadow-medium" src="/images/partners/zitar.jpg" width="180" height="65" alt="tech-krep">
            </div>
            <div>
                <img class="uk-box-shadow-medium" src="/images/partners/stinger.jpg" width="180" height="65" alt="tech-krep">
            </div>
            <div>
                <img class="uk-box-shadow-medium" src="/images/partners/mtk.jpg" width="180" height="65" alt="tech-krep">
            </div>

        </div>



    </div>

    <div class="uk-child-width-1-2@m uk-grid-match uk-margin-bottom" uk-grid>
        <div>
            <div class="uk-card uk-card-small uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-left;">
                <h3 class="uk-card-title">Вы найдете у нас именно то, что Вам нужно!</h3>
                <p>Наш ассортимент удовлетворяет практически любые запросы. <b>10 000</b> наименований позиций в прайсе соответствует наличию складским запасам на <b>98%</b>.</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-small uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-right;">
                <h3 class="uk-card-title">Удобная фасовка для магазинов, организаций!</h3>
                <p>От промкоробок и до любой, наиболее выгодной для Вас упаковки.</p>
            </div>
        </div>
    </div>

    <div class="uk-child-width-1-2@m uk-grid-match uk-margin-bottom" uk-grid>
        <div>
            <div class="uk-card uk-card-small uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-left;">
                <h3 class="uk-card-title">Вам больше не нужно искать спец крепеж!</h3>
                <p>Доверьте это нам! Более <b>10</b>-ти лет опыта работы с крепежом позволяет эффективно ориентироваться на метизном рынке. Мы найдем для Вас любой крепеж и привезем его в течение недели.</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-small uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-right;">
                <h3 class="uk-card-title">Вы можете рассчитывать на низкие цены!</h3>
                <p>Мы следим за тем, что бы наши цены оставались адекватными. Но! Даже если Вы нашли где-то дешевле, <b>ЗВОНИТЕ!</b> - договоримся...</p>
            </div>
        </div>
    </div>

    <div class="uk-child-width-1-2@m uk-grid-match uk-margin-bottom" uk-grid>
        <div>
            <div class="uk-card uk-card-small uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-left;">
                <h3 class="uk-card-title">Вы экономите не только деньги, но и время!</h3>
                <p>Моментальное обслуживание, начиная с выписки и оканчивая получением товара. Офис и склад находятся <b>в одном месте</b>.</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-small uk-card-default uk-card-body" uk-scrollspy="cls: uk-animation-slide-right;">
                <h3 class="uk-card-title">Вам не нужно беспокоиться о доставке!</h3>
                <p>Мы скомплектуем товар и доставим его до вашего склада в Кирове <b>Бесплатно!</b></p>
            </div>
        </div>
    </div>

@endsection