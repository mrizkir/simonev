@include('layouts.dore.l_header')
<body>
@yield('page_content')
<script src="{!!asset('js/modernizr.min.js')!!}"></script>
<script src="{!!asset('js/vendor.min.js')!!}"></script>
<script src="{!!asset('js/scripts.min.js')!!}"></script>
@yield('page_asset_js')
@yield('page_custom_js')
<script src="{!!asset('app.js')!!}"></script>
</body>
</html>