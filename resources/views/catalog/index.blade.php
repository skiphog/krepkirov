@extends('layouts.master')

@section('title','Каталог')
@section('description','Каталог товаров')

@section('content')
    <div class="uk-grid uk-grid-small">

        <div class="uk-width-medium-1-5 uk-hidden-small">

            <div class="content">

                <ul class="uk-nav">
                    <li><a href="{{ url('catalog') }}">Каталог</a></li>
                    <ul class="uk-nav-sub">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ url('catalog/' . $category->full_url) }}">{{ $category->nav_title }}</a>
                        </li>
                    @endforeach
                    </ul>
                </ul>

            </div>

        </div>

        <div class="uk-width-medium-4-5">
            <ul class="uk-breadcrumb content">
                <li><span>Каталог</span></li>
            </ul>

            <h1 class="content uk-text-center">Каталог</h1>

            <div class="content uk-margin-bottom uk-padding">
                @foreach($categories as $category)
                    <a class="uk-thumbnail uk-margin-left" href="{{ url('catalog/' . $category->full_url) }}">
                        <img src="{{ asset('images/' . $category->img) }}" alt="{{ $category->title }}" width="150" height="100">
                        <div class="uk-thumbnail-caption">
                            {{ $category->title }}
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
@endsection