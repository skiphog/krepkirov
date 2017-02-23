@extends('layouts.master')

@section('title','Вход')
@section('description','Вход в Крепежные материалы')

@section('content')
    <h1 class="uk-text-center content">Авторизация</h1>

    <div class="content uk-margin-bottom">


        {{ Form::open(['action' => 'Auth\LoginController@login','class' => 'uk-form uk-margin-bottom uk-container-center','style' => 'width:200px']) }}
            <fieldset>
                {{ Form::checkbox('remember', null, true,['class' => 'uk-hidden']) }}
                <div class="uk-form-row">
                    <div class="uk-form-icon">
                        <i class="uk-icon-at"></i>
                        {!! Form::email('email', null, ['class' => 'uk-form-large uk-form-width-medium', 'required autofocus']) !!}
                    </div>
                </div>
                <div class="uk-form-row">
                    <div class="uk-form-icon">
                        <i class="uk-icon-asterisk"></i>
                        {{ Form::password('password',['class' => 'uk-form-large uk-form-width-medium', 'required']) }}
                    </div>
                </div>

                @if ($errors->has('email') || $errors->has('password'))
                <div class="uk-form-row">
                    <div class="uk-form-controls uk-text-danger">Неверный логин или пароль</div>
                </div>
                @endif

                <div class="uk-form-row">
                    {!! Form::button('Войти',['type' => 'submit', 'class' => 'uk-width-1-1 uk-button-large uk-button uk-button-primary']) !!}
                </div>

            </fieldset>
        {{ Form::close() }}


    </div>

@endsection
