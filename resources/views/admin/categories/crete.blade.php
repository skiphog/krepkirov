@extends('layouts.master_admin')

@section('title','Админка')

@section('content')
    <h1 class="uk-text-center content">Создать категорию</h1>

    <div class="content uk-margin-bottom ">

        @include('errors.list')

        {{ Form::open(['route' => 'categories.store','class' => 'uk-form uk-form-stacked content uk-margin-bottom']) }}
            @include('admin.categories.form',['nameButton' => 'Добавить'])
        {{ Form::close() }}

    </div>


@endsection