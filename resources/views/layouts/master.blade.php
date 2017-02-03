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
    <link rel="stylesheet" href="/css/uikit.min.css">
    <style>
        html{
            overflow-y: scroll;
        }
        body{
            background: url("/images/background.png") repeat,linear-gradient(to left top, #28a5f5, #1e87f0) 0 0 no-repeat;
        }
        section{
            /*background-color: #fff;*/
        }
        .index-section{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="uk-container">

        @include('navigation.navbar')

        @yield('content')

        @yield('footer')

    </div>
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/uikit.min.js"></script>
    @stack('scripts')
</body>
</html>