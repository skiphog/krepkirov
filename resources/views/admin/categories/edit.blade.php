@extends('layouts.master_admin')

@section('title','Админка')

@section('content')
    <h1 class="uk-text-center content uk-box-shadow-medium">Редактировать категорию</h1>

    <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding">

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

    <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding">

        @include('errors.list')
        @include('message.flash')

        {{ Form::model($category,['method' => 'PUT','route' => ['categories.update',$category->id],'class' => 'uk-form-stacked']) }}
        @include('admin.categories.form',['nameButton' => 'Сохранить'])
        {{ Form::close() }}

    </div>


@endsection