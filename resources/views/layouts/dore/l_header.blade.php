<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{!!asset('font/iconsmind-s/css/iconsminds.css')!!}" />
    <link rel="stylesheet" href="{!!asset('font/simple-line-icons/css/simple-line-icons.css')!!}" />  
    <link rel="stylesheet" href="{!!asset('css/vendor/bootstrap.min.css')!!}" />  
    <link rel="stylesheet" href="{!!asset('css/vendor/bootstrap.rtl.only.min.css')!!}" />  
    <link rel="stylesheet" href="{!!asset('css/vendor/component-custom-switch.min.css')!!}" />  
    <link rel="stylesheet" href="{!!asset('css/vendor/perfect-scrollbar.css')!!}" />  
    @yield('page_asset_css')
    <link href="{!!asset('css/main.css')!!}" rel="stylesheet" type="text/css"> 
</head>