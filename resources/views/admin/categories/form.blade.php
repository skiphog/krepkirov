{{-- todo: Красивая выпадашка с поиском --}}
<div class="uk-margin">
    <label class="uk-form-label" for="parent_id">Выберите вложенность</label>
    <select id="parent_id" name="parent_id" class="uk-select">
        <option value="0">Главная</option>
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
    <div class="uk-inline-clip uk-transition-toggle">
        <img src="/images/{{ $category->img or config('s.default_img_category') }}" alt="image">
        {!! Form::hidden('img',null,['id' => 'img']) !!}
        <div class="uk-transition-fade uk-position-cover uk-position-small uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle">
            <div uk-form-custom>
                <input id="file" type="file">
                <span class="uk-link">Загрузить</span>
            </div>
        </div>
    </div>
</div>

<div class="uk-margin">
    {!! Form::label('description', 'Метаописание (нужно для поисковиков) одним предложением', ['class' => 'uk-form-label']) !!}
    {!! Form::textarea('description',null,['class' => 'uk-textarea','rows' => 4,'placeholder' => 'Болты стальные с шестигранной головкой и метрической резьбой. Без покрытия.']) !!}
</div>

<div class="uk-margin">
    {!! Form::label('text', 'Описание', ['class' => 'uk-form-label']) !!}
    {!! Form::textarea('text',null,['class' => 'uk-textarea','rows' => 5,'placeholder' => 'Болты стальные с шестигранной головкой и метрической резьбой. Без покрытия.']) !!}
</div>


{{-- todo: Прикрутить EDITOR --}}
{!! Form::submit($nameButton,['class' => 'uk-button uk-button-primary']) !!}

@push('scripts')
<script>
$(document).ready(function () {

    var send = true;

    $("#file").on("change", function () {
        if (!window.FormData || !send) {
            alert("Forbidden 403");
            return;
        }
        var file = $(this).get(0).files[0];
        if (file.type.match("image.*") === null || file.name.match(new RegExp("^[^/]+.(jpg|jpeg|gif|png)$", "i")) === null) {
            alert("Допущены к загрузке только картинки");
            return;
        }
        var data = new FormData();
        data.append("categoryUpload", "image");
        data.append("categoryUpload", file);

        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: '/admin/upload',
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function () {
                send = false;

            },
            success: function (json) {
                send = true;
                if(json['status'] !== 1) {
                    return;
                }
                $('#img').val(json['file_name']).prev('img').attr('src','/images/' + json['file_name']);

            }
        });
    });

});
</script>
@endpush