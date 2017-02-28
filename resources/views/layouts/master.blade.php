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
    @yield('css')
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/uikit.min.v2.js"></script>
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
    {{--<script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter17497954 = new Ya.Metrika({id:17497954, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } });  var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="//mc.yandex.ru/watch/17497954" style="position:absolute; left:-9999px;" alt="" /></div></noscript>--}}
</body>
</html>