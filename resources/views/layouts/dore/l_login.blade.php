@include('layouts.dore.l_header')
<body class="background show-spinner">
@yield('page_content')
<script src="{!!asset('js/vendor/jquery-3.3.1.min.js')!!}"></script>
<script src="{!!asset('js/vendor/bootstrap.bundle.min.js')!!}"></script>
<script src="{!!asset('js/dore.script.js')!!}"></script>
<script src="{!!asset('js/scripts.js')!!}"></script>
<script src="{!!asset('app.js')!!}"></script>
@yield('page_asset_js')
@yield('page_custom_js')
</body>
</html>