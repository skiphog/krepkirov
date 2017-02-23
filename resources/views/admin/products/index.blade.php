@extends('layouts.master_admin')

@section('title','Товары')

@section('content')

    <h1 class="content uk-text-center">Товары</h1>

    <div class="content uk-clearfix uk-flex-middle uk-form uk-margin-bottom">

        <div class="uk-float-left">
            <select id="category" name="category" class="uk-select">
                <option value="0">Без категорий</option>
                @include('admin.products.select',['categories' => $menus,'shift' => 0])
            </select>
        </div>

        <div class="uk-float-right uk-form-icon">
            <i class="uk-icon-cog"></i>
            <input id="search" class="uk-form-width-large" type="text" placeholder="Искать товар">
        </div>

    </div>

    @include('message.flash')

    <div id="response" class="content uk-margin-bottom">
        @include('admin.products.result_search')
    </div>


@endsection

@push('scripts')
<script src="/js/sortable.min.js"></script>
<script>
$(document).ready(function () {
    var response = $('#response'),t;

    function searchProduct(a,b,c) {
        $.get("/admin/products/" + b, {data: a}, function (j) {
            response.html(j);
            if(typeof c !== "undefined") {
                c.removeClass("uk-icon-spin uk-text-success");
            }
        });
    }

    response.on('change.uk.sortable', function () {
        $('#save-product').show();
    });

    response.on('click','.del-product',function (e) {
       e.preventDefault();
       if(confirm('Удалить товар?') === true) {
           var a = $(this);
           $.post('/admin/products/destroy',{id:a.data('id')},function (j) {
               a.parent().parent().slideUp(500,function () {
                   $(this).remove();
               });
               UIkit.notify("<i class='uk-icon-check'></i> Карточка товара удалена", {
                   pos: "top-center",
                   status: "success"
               });
           });
       }
    });

    $('#search').on('input propertyChange',function () {
        clearTimeout(t);
        var a = $(this),d = a.prev();
        d.addClass("uk-icon-spin uk-text-success");
        t = setTimeout(searchProduct,1000,a.val(),'search',d);
    });

    $('#category').on('change',function () {
        $('#search').val('');
        var d = parseInt($(this).val());
        if(d === 0) {
            return searchProduct('','search');
        }
        searchProduct(d,'get');
    });

    $('#category').selectator({
        labels: {
            search: 'Поиск...'
        }
    });



});
</script>
@endpush