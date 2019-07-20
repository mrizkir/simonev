@yield('page_custom_html')
<script src="{!!asset('themes/silverage/assets/js/modernizr.min.js')!!}"></script>
<script src="{!!asset('themes/silverage/assets/js/vendor.min.js')!!}"></script>
<script src="{!!asset('themes/silverage/assets/js/scripts.min.js')!!}"></script>
@yield('page_asset_js')
<script type="text/javascript">
    let url_admin="{{route('dashboard.index')}}";
    let url_current_page="{{Helper::getCurrentPageURL()}}";
    let token = "{{ csrf_token() }}";
    let baseUserImageURL = "{{asset('storage/images/users')}}/";
</script>
@yield('page_custom_js')
</body>
</html>