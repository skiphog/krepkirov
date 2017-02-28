<!doctype html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <link rel="shortcut icon" href="/images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/images/apple-touch-icon.png">
    <link rel="stylesheet" href="/css/uikit.almost-flat.min.v2.css">
    <link rel="stylesheet" href="/js/nprogress/nprogress.min.css">

    <link rel="stylesheet" href="/css/sortable.almost-flat.min.css">
    <link rel="stylesheet" href="/css/form-file.almost-flat.min.css">
    <link rel="stylesheet" href="/css/progress.almost-flat.min.css">
    <link rel="stylesheet" href="/css/dropBox.css">
    <link rel="stylesheet" href="/js/trumbowyg/trumbowyg.min.css">
    <link rel="stylesheet" href="/js/selectator/fm.selectator.jquery.min.css">

    @yield('css')

    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/uikit.min.v2.js"></script>
    <script src="/js/nprogress/nprogress.min.js"></script>

    <script src="/js/trumbowyg/trumbowyg.min.js"></script>
    <script src="/js/selectator/fm.selectator.jquery.js"></script>

    @yield('script')
    <style>
        .selectator_input{height:35px !important}
        .selectator_element.single{height:27px;padding: 4px 10px !important}
        .order-table{width:inherit}
        .uk-nav ul a:focus{color:#444}
    </style>
</head>
<body>
<div class="uk-container uk-container-center">
    <header class="uk-margin-bottom uk-margin-top">
        @include('admin.navigation')
    </header>

    <section>
        @yield('content')
    </section>

    <aside>
        @yield('aside')
    </aside>

    <footer>
        @yield('footer')
    </footer>
</div>

@yield('modal')

<script>
    var send = true;
    function changeSend(){send = !send;}
    $.ajaxSetup({global:true,headers:{'X-CSRF-TOKEN':'{{ csrf_token()}}'}});
    $.ajaxPrefilter(function(a,b,jqXHR) {if(!send) {jqXHR.abort();}});
    function getAjax(url, method, type, callback, data) {

        if(typeof data === 'undefined') {
            data = [];
        }

        method = method.toUpperCase();

        if (method === 'PUT' || method === 'DELETE') {
            $.merge(data,[{name:'_method', value: method}]);
            method = 'POST';
        }

        $.ajax({
            url: url,
            type: method,
            dataType: type,
            data: data,
            beforeSend:function() {
                changeSend();
                NProgress.start();
            },
            complete:function() {
                changeSend();
                setTimeout(NProgress.done, 300);
            },
            error:function () {
                UIkit.notify('<i class="uk-icon-frown-o"></i> Ошибка', {pos:'top-center',status:'danger'});
            },
            success: callback
        });
    }
</script>
@stack('scripts')
</body>
</html>