@extends('layouts.master')

@section('title','Каталог')
@section('description','Каталог товаров')

@section('content')
    <div class="uk-grid-small" uk-grid>

        <div class="uk-width-1-4@m uk-visible@m">
            <div class="uk-card uk-card-default uk-card-body">
                <ul class="uk-nav uk-nav-default">
                    <li class="uk-nav-header">Каталог</li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ url('catalog/' . $category->full_url) }}">{{ $category->nav_title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="uk-width-3-4@m">
            <ul class="uk-breadcrumb uk-box-shadow-medium">
                <li><span>Каталог</span></li>
            </ul>

            <div class="content uk-box-shadow-medium uk-margin-bottom">

                <h1 class="uk-text-center">Каталог</h1>
            </div>

            <hr class="uk-divider-icon">


            <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding">
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
        </div>
    </div>
@endsection