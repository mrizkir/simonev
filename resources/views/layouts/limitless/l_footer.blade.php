@yield('page_custom_html')
<script src="{!!asset('themes/limitless/assets/js/jquery.min.js')!!}"></script>
<script src="{!!asset('themes/limitless/assets/js/bootstrap.min.js')!!}"></script>
<script src="{!!asset('themes/limitless/assets/js/nicescroll.min.js')!!}"></script>
<script src="{!!asset('themes/limitless/assets/js/drilldown.js')!!}"></script>
<script src="{!!asset('themes/limitless/assets/js/pace.min.js')!!}"></script>
@yield('page_asset_js')
<script type="text/javascript">
    let url_admin="{{route('dashboard.index')}}";
    let url_current_page="{{Helper::getCurrentPageURL()}}";
    let token = "{{ csrf_token() }}";
    let baseUserImageURL = "{{asset('storage/images/users')}}/";
</script>
<script src="{!!asset('themes/limitless/app.js')!!}"></script>
@yield('page_custom_js')
</body>
</html>