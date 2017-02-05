{{-- todo: Красивая выпадашка с поиском --}}
<div class="uk-margin">
    <label class="uk-form-label" for="parent_id">Выберите подкатегорию</label>
    <select id="parent_id" name="parent_id" class="uk-select">
        <option value="0">Родительская</option>
        @include('admin.categories.select',['categories' => $categories,'shift' => 0,'id' => $category->parent_id ?? 0])
    </select>
</div>

<div class="uk-margin">
    {!! Form::label('title', 'Название', ['class' => 'uk-form-label']) !!}
    {!! Form::text('title',null,['class' => 'uk-input','placeholder' => 'Супер болты']) !!}
</div>

<div class="uk-margin">
    {!! Form::label('nav_title', 'Как будет называться в меню', ['class' => 'uk-form-label']) !!}
    {!! Form::text('nav_title',null,['class' => 'uk-input','placeholder' => 'Супер болты']) !!}
</div>

<div class="uk-margin">
    {!! Form::label('standard', 'Спецификация', ['class' => 'uk-form-label']) !!}
    {!! Form::text('standard',null,['class' => 'uk-input','placeholder' => 'DIN 933']) !!}
</div>

<div class="uk-margin">
    {!! Form::label('additionally', 'Предназначение', ['class' => 'uk-form-label']) !!}
    {!! Form::text('additionally',null,['class' => 'uk-input','placeholder' => 'бетон, кирпич']) !!}
</div>

<div class="uk-margin">
    {!! Form::label('description', 'Метаописание (нужно для поисковиков) одним предложением', ['class' => 'uk-form-label']) !!}
    {!! Form::textarea('description',null,['class' => 'uk-textarea','rows' => 4,'placeholder' => 'Болты стальные с шестигранной головкой и метрической резьбой. Без покрытия.']) !!}
</div>

<div class="uk-margin">
    {!! Form::label('text', 'Описание', ['class' => 'uk-form-label']) !!}
    {!! Form::textarea('text',null,['class' => 'uk-textarea','rows' => 5,'placeholder' => 'Болты стальные с шестигранной головкой и метрической резьбой. Без покрытия.']) !!}
</div>
{{-- todo: Убрать DEFAULT --}}
{!! Form::hidden('img','anker/anker_gayka.png') !!}


{{-- todo: Прикрутить EDITOR --}}
{!! Form::submit($nameButton,['class' => 'uk-button uk-button-primary']) !!}