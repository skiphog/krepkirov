@extends('layouts.master_admin')

@section('title','Админка')

@section('content')
    <h1 class="uk-text-center content uk-box-shadow-medium">Создать категорию</h1>

    <div class="content uk-box-shadow-medium uk-margin-bottom uk-padding">

        @include('errors.list')

        {{ Form::open(['route' => 'categories.store','class' => 'uk-form-stacked']) }}
            @include('admin.categories.form',['nameButton' => 'Добавить'])
        {{ Form::close() }}

    </div>


@endsection