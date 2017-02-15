@extends('layouts.master_admin')

@section('title','Админка')

@section('content')
    <h1 class="uk-text-center content">Редактировать категорию</h1>

    <div class="content uk-margin-bottom">

        <div class="uk-grid uk-flex-middle">
            <div class="uk-width-medium-1-5">
                <img src="{{ asset('images/' . $category->img) }}" alt="{{ $category->title }}" width="150" height="100">
            </div>

            <div class="uk-width-medium-4-5">
                <h1>{{ $category->title }}</h1>
                @if(!empty($category->standard))
                    <p class="krep-standard">{{ $category->standard }}</p>
                @endif
                @if(!empty($category->additionally))
                    <p class="krep-additionally">{{ $category->additionally }}</p>
                @endif
                <div class="krep-description">{!! $category->text !!}</div>
            </div>
        </div>

    </div>

    <div class="content uk-margin-bottom">

        @include('errors.list')
        @include('message.flash')

        {{ Form::model($category,['method' => 'PUT','route' => ['categories.update',$category->id],'class' => 'uk-form uk-form-stacked content uk-margin-bottom']) }}
            @include('admin.categories.form',['nameButton' => 'Сохранить'])
        {{ Form::close() }}

    </div>


@endsection