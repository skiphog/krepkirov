@extends('layouts.master')

@section('title',$category->title)
@section('description',$category->description)

@section('content')

    <div class="uk-grid-small" uk-grid>

        <div class="uk-width-1-4@m uk-visible@m">
            <div class="uk-card uk-card-default uk-card-body">
                <ul class="uk-nav uk-nav-default">
                    <li class="uk-nav-header">Каталог</li>
                    @foreach($menus as $menu)
                        <li @if($category->id === $menu['id']) class="uk-active" @endif>
                            <a href="{{ url('catalog/' . $menu['full_url']) }}">{{ $menu['nav_title'] }}</a>
                            @if(!empty($menu['children']) && strpos($category->full_url,$menu['full_url']) === 0)
                                <ul class="uk-nav-sub">
                                    @foreach($menu['children'] as $child)
                                        @include('menu.cat_menu',['menu' => $child])
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="uk-width-3-4@m">
            <ul class="uk-breadcrumb uk-box-shadow-medium">
                <li><a href="{{ url('catalog') }}">Каталог</a></li>
                @foreach($category->breadcrumbs as $breadcrumb)
                    <li><a href="{{ url('catalog/' . $breadcrumb['url']) }}">{{ $breadcrumb['title'] }}</a></li>
                @endforeach
                <li><span>{{ $category->title }}</span></li>
            </ul>

            <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding-small">

                <div class="uk-flex-center uk-text-center" uk-grid>
                    <div class="uk-width-1-3@m">
                        <img src="{{ asset('images/' . $category->img) }}" alt="{{ $category->title }}">
                    </div>
                    <div class="uk-width-2-3@m">
                        <h1>{{ $category->title }}</h1>
                        {!! $category->text !!}
                    </div>
                </div>
            </div>

            <hr class="uk-divider-icon">

            @unless($categories->isEmpty())
            <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding-small">
                <div class="uk-grid-match uk-grid-small uk-child-width-1-4@s uk-flex-center uk-text-center" uk-grid>
                    @foreach($categories as $category)
                        <div>
                            <div class="uk-card uk-card-default uk-card-small uk-card-body uk-card-hover">
                                <a class="uk-link-reset" href="{{ url('catalog/' . $category->full_url) }}">
                                    <img src="{{ asset('images/' . $category->img) }}" alt="{{ $category->title }}">
                                    <br>
                                    {{ $category->title }}
                                    @unless(empty($category->standard))
                                        <p class="uk-text-bold">{{ $category->standard }}</p>
                                    @endunless
                                    @unless(empty($category->additionally))
                                        <p class="uk-text-muted">{{ $category->additionally }}</p>
                                    @endunless
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endunless

            @unless($products->isEmpty())
            <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding-small">

                @foreach($products as $product)
                    <div class="content uk-box-shadow-medium uk-margin-small-bottom uk-padding-small uk-grid-collapse uk-flex-middle" uk-grid>
                        <div class="uk-width-1-5">

                        </div>
                        <div class="uk-width-3-5">
                            {{ $product->name }}
                        </div>
                        <div class="uk-width-1-5">
                            <a href="#" class="uk-icon-button uk-margin-left" uk-icon="icon: pencil" title="Редактировать" uk-tooltip="pos: left"></a>
                        </div>
                    </div>
                @endforeach
            </div>
            @endunless

        </div>



    </div>



@endsection
