@extends('layouts.master_admin')

@section('title','Админка')

@section('content')

    <h1 class="uk-text-center content">Редактировать товар</h1>

    @include('message.flash')

    <div class="content uk-margin-bottom">

        {{ Form::model($product,['method' => 'PUT', 'action' => ['Admin\ProductController@update', $product->id], 'class' => 'uk-form uk-grid']) }}
        <div class="uk-width-medium-1-3">

            <figure class="uk-overlay uk-overlay-hover">
                <img id="img-product" src="{{ !empty($product->image) ? '/images/catalog/' . $product->image . '_400.jpg': '/images/' . config('s.default_img_product_400') }}" alt="image" width="400" height="400">
                {!! Form::hidden('image',null,['id' => 'image']) !!}
                <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom uk-overlay-slide-bottom uk-text-center">
                    <a id="change-img" data-img="{{ asset(!empty($product->image) ? '/images/catalog/' . $product->image . '_400.jpg': '/images/' . config('s.default_img_product_400')) }}" data-name="{{ $product->name }}">Загрузить</a>
                </figcaption>
            </figure>

            <div id="warning" class="uk-alert uk-alert-warning uk-text-center" style="display: none">
                Для того, что бы сохранить картинку, нужно сохранить карточку товара
            </div>


        </div>

        <div class="uk-width-medium-2-3 uk-form-stacked">
            <h2>{{ $product->name }}</h2>

            <div class="uk-form-row">
                <label class="uk-form-label" for="category_id">Категория</label>
                <select id="category_id" name="category_id" class="uk-select">
                    <option value="0">Без категории</option>
                    @include('admin.products.edit_select',['categories' => $categories,'shift' => 0])
                </select>
            </div>

            <div class="uk-form-row">
                {!! Form::label('packing', 'Кол-во в упаковке', ['class' => 'uk-form-label']) !!}
                {!! Form::number('packing',null) !!}
                {{ $product->unit  === 'тыс. шт' ? 'шт' : $product->unit }}
            </div>

            <div class="uk-form-row">
                {!! Form::label('description', 'Описание', ['class' => 'uk-form-label']) !!}
                {!! Form::textarea('description',null,['class' => 'uk-margin-bottom','rows' => 5]) !!}
            </div>

            {!! Form::button('Сохранить',['type' => 'submit', 'class' => 'uk-button uk-button-primary uk-margin-top']) !!}
        </div>
        {{ Form::close() }}
    </div>

@endsection

@section('modal')
    <div id="m-upload" class="uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog-blank">
            <button class="uk-modal-close uk-close"></button>

            <div class="uk-width-medium-1-2 uk-container-center uk-text-center">

                <div class="imageBox">
                    <div class="thumbBox"></div>
                    <div class="spinner"><i class="uk-icon-cog uk-icon-spin uk-icon-large"></i></div>
                </div>
                <div class="action" style="display: none">
                    <p class="uk-text-bold"></p>
                    <div class="uk-form-file">
                        <button class="uk-button">Выбрать картинку</button>
                        <input id="file" type="file">
                    </div>
                    <div class="uk-button-group">
                        <button id="btnZoomIn" class="uk-button"><i class="uk-icon-search-plus"></i></button>
                        <button id="btnZoomOut" class="uk-button"><i class="uk-icon-search-minus"></i></button>
                    </div>
                    <button id="btnCrop" style="display: none" class="uk-button uk-button-primary">Сохранить</button>
                    <div class="uk-progress uk-progress-striped uk-active" style="display: none">
                        <div class="uk-progress-bar" style="width: 100%;">Загружаю...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="/js/cropbox-min.js"></script>
<script>
$(document).ready(function () {

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
    var modal = UIkit.modal("#m-upload"),cropper,btnCrop = $("#btnCrop"),options={thumbBox:".thumbBox",spinner:".spinner"};

    $('#change-img').on('click',function (e) {
        e.preventDefault();
        var a = $(this);
        options.imgSrc = a.data('img');
        cropper = $(".imageBox").cropbox(options);
        modal.find(".action").show().children("p").html(a.data('name'));
        modal.find(".imageBox").attr("style", "");
        modal.find("#file").val("");
        modal.find(".spinner").show();
        modal.show();
    });

    modal.on("hide.uk.modal", function () {
        closeModal();
    });

    $("#file").on("change", function () {
        var a = this.files[0];
        if ("undefined" != a && null != a) {
            if (!a.type.match("image.*"))return void alert("Это какая-то не картинка");
            var b = new FileReader;
            b.onload = function (a) {
                options.imgSrc = a.target.result;
                cropper = $(".imageBox").cropbox(options);
                btnCrop.show();
            };
            b.readAsDataURL(a);
        }
    });

    btnCrop.on("click", function () {
        btnCrop.next().show();
        $.post("/admin/upload/product", {image:cropper.getDataURL()}, function (j) {
            if(j['status'] === 1) {
                $('#img-product').attr('src',j['file'])
                    .next().val(j['input'])
                    .next().find('a').data('img',j['file']);
            }
            modal.hide();
            $('#warning').show();
        });
    });
    $("#btnZoomIn").on("click", function () {
        cropper.zoomIn();
    });
    $("#btnZoomOut").on("click", function () {
        cropper.zoomOut();
    });

    function closeModal() {
        btnCrop.hide();
        modal.find(".action").hide();
        btnCrop.next().hide();
    }






});
</script>

@endpush