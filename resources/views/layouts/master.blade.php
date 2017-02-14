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
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/uikit.min.js"></script>
    <style>

        :focus {
            outline: none !important;
        }

        html{
            height: 100%;
        }

        body{
            min-height: 100%;
            overflow-y: scroll;
            background: url("/images/background.png") #1e87f0;
        }
        .content,.krep-navbar {
            padding: 5px;
        }

        .content {
            background-color: rgba(255, 255, 255, 0.9);;
        }

        .general-navbar,.content,.shadow-box,.show-img:hover  {
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .krep-navbar {
            background-color: rgba(30, 135, 240, 0.87);
        }

        .krep-brand,.krep-navbar .uk-navbar-nav > li > a,.krep-navbar > a:hover,.cart-added,.cart-added:focus,.cart-added:active,.cart-added:hover{
            color: #fff;
        }

        .krep-brand {
            font-size: 18px;
        }

        .krep-navbar .uk-navbar-nav > li > a {
            height: 40px;
            margin: 0;
            border: none;
            text-shadow: none;
            font-size: 15px;
        }

        .krep-navbar > a:hover {
            text-decoration: none;
        }

        .krep-navbar .uk-navbar-nav > li:hover > a, .krep-navbar .uk-navbar-nav > li > a:focus,.krep-navbar .uk-navbar-nav > li > a:active, .krep-navbar .uk-navbar-nav > li.uk-open > a {
            background-color: transparent;
            color: #ffff00;
        }

        .carts{
            min-height: 160px;
            padding: 20px 20px 0;
        }
        .cart-mini{
            padding: 10px;
            z-index: 9999;
        }

        .uk-link:hover, a:hover,li.uk-active > a,a.show-product {
            color: #444;
        }
        .krep-standard,.krep-additionally{
            margin: 0;
        }

        .krep-standard{
            font-weight: 700;
        }
        .krep-additionally{
            color: #999!important;
        }
        .krep-description{
            margin-top: 15px;
        }
        .krep-cart-product{
            margin: 0 0 10px 10px;
            width: 200px;
            height: 250px;
            vertical-align: top;
            text-align: center;
        }
        .krep-input{
            width: 80px;
        }

        .cart-added,.cart-added:focus {
            background-color: #8cc14c;
        }

        .cart-added:hover {
            background-color: #8ec73b;
        }

        .cart-added:active{
            background-color:#72ae41;
        }

        .show-img{
            cursor: pointer;
        }

        .prod-description{
            display: none;
        }
        .uk-table th, .uk-table td {
            border-bottom: 1px solid #ddd;
        }

        .input-required:after{
            content: ' *';
            color: #ff0000;
        }


    </style>
</head>
<body>
    <div class="uk-container uk-container-center">
        <header class="uk-margin-bottom general-navbar uk-margin-top">
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
            @yield('footer')
        </footer>
    </div>

    @yield('modal')
    @stack('scripts')
    <script>
        function clearCart() {
            if(confirm('Удалить заказ?') === true) {
                document.getElementById('clear-cart').submit();
            }
        }
    </script>
</body>
</html>