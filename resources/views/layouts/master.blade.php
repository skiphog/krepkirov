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
    <link rel="stylesheet" href="/css/uikit.almost-flat.min.css">
    @yield('css')
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/uikit.min.js"></script>
</head>
<body>
    <div class="uk-container uk-container-center">
        <header class="uk-margin-bottom uk-margin-top">
            @include('navigation.navigation')
        </header>

        @include('cart.cart_min')

        <section>
            @yield('content')
        </section>

        <aside>
            @yield('aside')
        </aside>

        <footer>
            @include('footer.footer')
        </footer>
    </div>

    @yield('modal')
    @stack('scripts')
</body>
</html>