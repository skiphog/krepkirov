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
        html{
            overflow-y: scroll;
            /*background: url("/images/background.png") repeat,linear-gradient(to left top, #28a5f5, #1e87f0) 0 0 no-repeat;*/
            background: url("/images/background.png") #1e87f0;
        }

        .uk-logo,.uk-logo:focus,.uk-logo:hover,.uk-navbar-nav>li:hover>a, .uk-navbar-nav>li>a.uk-open, .uk-navbar-nav>li>a:focus {
            color: #fff;
        }

        .uk-navbar-nav>li>a {
            color: rgba(255,255,255,0.8);
            position: relative;
        }

        .uk-navbar-nav>li>a:before{
            content: '';
            display: block;
            position: absolute;
            left: 15px;
            right: calc(102% - 15px);
            bottom: 30px;
            height: 1px;
            background-color: currentColor;
            -webkit-transition: .3s ease-in-out;
            transition: .3s ease-in-out;
            -webkit-transition-property: right;
            transition-property: right;
        }

        .uk-navbar-nav>li>a:hover::before {
            right: 15px;
        }
        .general-navbar {
            background-color: rgba(30, 135, 240, 0.87);
        }

        .content,.uk-card-default,.uk-breadcrumb{

            background-color: rgba(255, 255, 255, 0.9);;
        }

        .bottom-bar{
            height: 25px;
            padding-bottom: 10px;
        }
        .uk-breadcrumb{
            padding: 5px;
        }
        li.uk-active>a {
            color: #333 !important;
        }
        .uk-form-width-small {
            width: 100px;
        }
        .uk-padding-xmall{
            padding: 5px;
        }
        .cart-added,.cart-added:focus,.cart-added:active{
            color: #fff;
            background: #1cc12f;
        }
        .cart-added:hover{
            color: #fff;
            background: #19b328;
        }
        .cart-table {
            background: #fff;
        }

    </style>
</head>
<body class="uk-container">
    <header class="uk-margin-bottom general-navbar uk-box-shadow-medium">
        @include('navigation.top_navbar')
        @include('navigation.bottom_navbar')
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