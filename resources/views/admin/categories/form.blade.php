<div class="uk-form-row">
    <label class="uk-form-label" for="parent_id">Выберите вложенность</label>
    <select id="parent_id" name="parent_id" class="uk-select">
        <option value="0">Главная</option>
        @include('admin.categories.select',['categories' => $categories,'shift' => 0,'id' => $category->parent_id ?? 0])
    </select>
</div>

<div class="uk-form-row">
    {!! Form::label('title', 'Название', ['class' => 'uk-form-label']) !!}
    {!! Form::text('title',null,['class' => 'uk-form-width-large','placeholder' => 'Супер болты', 'required']) !!}
</div>

<div class="uk-form-row">
    {!! Form::label('nav_title', 'Как будет называться в меню', ['class' => 'uk-form-label']) !!}
    {!! Form::text('nav_title',null,['placeholder' => 'Супер болты', 'required']) !!}
</div>

<div class="uk-form-row">
    {!! Form::label('standard', 'Спецификация', ['class' => 'uk-form-label']) !!}
    {!! Form::text('standard',null,['class' => 'uk-form-width-large','placeholder' => 'DIN 933']) !!}
</div>

<div class="uk-form-row">
    {!! Form::label('additionally', 'Предназначение', ['class' => 'uk-form-label']) !!}
    {!! Form::text('additionally',null,['class' => 'uk-form-width-large','placeholder' => 'бетон, кирпич']) !!}
</div>

<div class="uk-form-row">
    <figure class="uk-overlay uk-overlay-hover">
        <img class="uk-overlay-spin" src="/images/{{ $category->img or config('s.default_img_category') }}" width="150" height="100" alt="image">
        {!! Form::hidden('img',null,['id' => 'img']) !!}
        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom uk-overlay-slide-bottom uk-text-center">
            <div class="uk-form-file">
                Загрузить
                <input id="file" type="file">
            </div>
        </figcaption>
    </figure>
</div>

<div class="uk-form-row">
    {!! Form::label('description', 'Метаописание (нужно для поисковиков) одним предложением', ['class' => 'uk-form-label']) !!}
    {!! Form::textarea('description',null,['rows' => 4,'placeholder' => 'Болты стальные с шестигранной головкой и метрической резьбой. Без покрытия.']) !!}
</div>

<div class="uk-form-row">
    {!! Form::label('text', 'Описание', ['class' => 'uk-form-label']) !!}
    {!! Form::textarea('text',null,['id' => 'editor', 'class' => 'uk-margin-bottom','placeholder' => 'Болты стальные с шестигранной головкой и метрической резьбой. Без покрытия.']) !!}
</div>

{!! Form::button($nameButton,['type' => 'submit', 'class' => 'uk-button uk-button-primary']) !!}

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

    $('#editor').trumbowyg({
        lang: 'ru',
        btns: [['viewHTML'],['formatting'],'btnGrp-semantic',['superscript', 'subscript'],['link'],
            ['foreColor'],'btnGrp-justify','btnGrp-lists',['horizontalRule'],['removeformat'],['fullscreen']
        ]
    });

    $('#parent_id').selectator({
        labels: {
            search: 'Поиск...'
        }
    });

});
</script>
@endpush