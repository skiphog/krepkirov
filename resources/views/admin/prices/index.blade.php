@extends('layouts.master_admin')

@section('title','Прайсы')

@section('content')

    <h1 class="content uk-text-center">Прайсы</h1>

    @if(!$prices->isEmpty())
        <div class="content uk-margin-bottom">
            <table class="uk-table">
                <thead>
                    <tr>
                       <th>Прайс</th>
                       <th>Файл</th>
                       <th>Обновлен</th>
                       <th>Размер</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($prices as $price)
                    <tr id="price-{{ $price->id }}">
                        <td><a href="{{ $price->url }}">{{ $price->name }}</a></td>
                        <td>{{ $price->file }}</td>
                        <td>{{ $price->m_date->format('d-m-Y H:i') }} <span class="uk-text-muted uk-text-small">{{ $price->m_date->diffForHumans() }}</span></td>
                        <td>{{ $price->size }} Мб</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="content uk-margin-bottom uk-text-center">
            <div class="uk-form-file">
                <button class="uk-button uk-button-primary uk-button-large">Загрузить прайсы</button>
                <input id="file" type="file" name="price" multiple>
            </div>

            <div id="progressbar" class="uk-progress uk-hidden">
                <div class="uk-progress-bar" style="width: 0;">Загрузка</div>
            </div>
        </div>

    @endif
@endsection

@push('scripts')
<script src="/js/upload.min.js"></script>
<script>
$(document).ready(function () {

    var progressbar = $("#progressbar"),
        bar         = progressbar.find('.uk-progress-bar'),
        settings    = {

            headers:{'X-CSRF-TOKEN': '{{ csrf_token() }}'},

            action: '/admin/price/upload',

            allow : '*.xls',

            type: 'json',

            loadstart: function() {
                bar.css("width", "0%").text("0%");
                progressbar.removeClass("uk-hidden");
            },

            progress: function(percent) {
                percent = Math.ceil(percent);
                bar.css("width", percent+"%").text(percent+"%");
            },

            complete:function (r) {
                if(r['status'] === 0) {
                    UIkit.notify("<i class='uk-icon-frown-o'></i> Ошибка при загрузке ", {pos: "top-center", status: "danger"});
                    return;
                }
                $('#price-' + r['res']['id']).html(r['res']['html']);

                UIkit.notify('<i class="uk-icon-check"></i> Прайс ~ ' + r['res']['name'] + ' ~ загружен.', {pos: "top-center", status: "success"});
            },

            allcomplete: function() {

                bar.css("width", "100%").text("100%");

                setTimeout(function(){
                    progressbar.addClass("uk-hidden");
                }, 250);


            },
            notallowed: function (a) {
                UIkit.notify("<i class='uk-icon-frown-o'></i> Это какой-то не прайс ", {pos: "top-center", status: "danger"});
            }
        };

    var select = UIkit.uploadSelect($("#file"), settings);


})
</script>

@endpush