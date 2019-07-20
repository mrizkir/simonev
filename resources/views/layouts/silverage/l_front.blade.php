@include('layouts.silverage.l_header')
<body>
<!-- BEGIN OFF-CANVAS CATEGORY MENU-->
<div class="offcanvas-container" id="menu-categories">
    <a class="account-link" href="javascript:void(0)">
        <div class="user-ava">
            <img src="http://via.placeholder.com/128x128" alt="administrator">
        </div>
        <div class="user-info">
            <h6 class="user-name">Guest</h6>
            <span class="text-sm text-white opacity-60">Guest</span>
        </div>
    </a>
    <nav class="offcanvas-menu">
        <ul class="menu">
            <li class="active">
                <a href="{!!route('dashboard.index')!!}">STATISTIK</a>
            </li>              
        </ul>
    </nav>
</div>
<!-- END OFF-CANVAS CATEGORY MENU-->
<!-- BEGIN OFF-CANVAS MOBILE MENU-->
<div class="offcanvas-container" id="mobile-menu">
    <a class="account-link" href="javascript:void(0)">
        <div class="user-ava">
            <img src="http://via.placeholder.com/128x128" alt="administrator">
        </div>
        <div class="user-info">
            <h6 class="user-name">Guest</h6>
            <span class="text-sm text-white opacity-60">Guest</span>
        </div>
    </a>
    <nav class="offcanvas-menu">
        <ul class="menu">
            <li class="active">
                <a href="{!!route('dashboard.index')!!}">STATISTIK</a>
            </li>              
        </ul>
    </nav>
</div>                                
<!-- END OFF-CANVAS MOBILE MENU-->
                
<!-- NAVBAR-->
<header class="navbar navbar-stuck">
    <div class="site-branding">
        <div class="inner">
            <!-- OFF-CANVAS TOGGLE (#MENU-CATEGORIES)-->
            <a class="offcanvas-toggle cats-toggle" href="#menu-categories" data-toggle="offcanvas"></a>
            <!-- OFF-CANVAS TOGGLE (#MOBILE-MENU)-->
            <a class="offcanvas-toggle menu-toggle" href="#mobile-menu" data-toggle="offcanvas"></a>
            <!-- SITE LOGO-->
            <a class="site-logo" href="{!!route('dashboard.index')!!}">
                <img src="http://via.placeholder.com/344x88" alt="PVR_Tech_Studio">
            </a>
        </div>
    </div>
    <!-- BEGIN TOOLBAR-->
    <div class="toolbar">
        <div class="inner">
            <div class="tools">     
                <div class="account">
                    <a href="javascript:void(0)"></a><i class="icon-head"></i>
                    <ul class="toolbar-dropdown">
                        <li class="sub-menu-user">
                            <div class="user-ava">
                                <img src="http://via.placeholder.com/128x128" alt="Administrator">
                            </div>
                            <div class="user-info">
                                <h6 class="user-name">Guest</h6>
                                <span class="text-xs text-muted">Guest</span>
                            </div>
                        </li>                       
                        <li><a href="javascript:void(0)"> <i class="icon-lock"></i> Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END TOOLBAR-->
</header>
                
<!-- BEGIN MAIN CONTENT-->
<div class="offcanvas-wrapper">

    <!-- BEGIN BREADCRUMBS-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>@yield('page_header')</h1>
                <small>@yield('page_info')</small>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="{!!route('dashboard.index')!!}">Home</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    @yield('page_breadcrumb')
                </ul>
                @yield('page_breadcrumbelement') 
                @yield('page_headerelement')   
            </div>
        </div>
    </div>
    <!-- END BREADCRUMBS-->
                
    <!-- PAGE CONTENT BEGINS -->
    <div class="" id="container">
        @include('layouts.silverage.l_formmessages') 
        @yield('page_content')
    </div>
    <!-- END CONTENT BEGINS -->
    <!-- BEGIN SITE FOOTER-->
    <footer class="site-footer footer-light fixed">
        <div class="container footer-copyright">
            <!-- COPYRIGHT-->
            <div class="column">
                2019 © All rights reserved.
            </div>
            <div class="column footer_right">
                {{config('app.name')}} Powered by <a href="http://bintankab.go.id">TIM IT KAB. BINTAN</a>
            </div>
        </div>
    </footer>
    <!-- END SITE FOOTER-->
</div>
<!-- END MAIN CONTENT-->
                
<!-- BEGIN BACK TO TOP BUTTON-->
<a class="scroll-to-top-btn" href="javascript:void(0)">
    <i class="icon-arrow-up"></i>
</a>
<!-- END BACK TO TOP BUTTON-->

<!-- Backdrop-->
<div class="site-backdrop"></div>

<!-- BEGIN PRELOADER -->
<div id="preloader">
    <div class="inner">
        <span class="loader"></span>
    </div>
</div>
<!-- END PRELOADER -->

<!-- BEGIN LIVE CUSTOMIZER -->
<div class="pvr-floated-chat-btn" id="live_customizer">
    <i class="icon-cog live_customizer_btn"></i>
    <span class="live_customizer_btn">Settings</span>
</div>
<!-- END LIVE CUSTOMIZER -->

<!-- BEGIN LIVE CUSTOMIZER -->
<div class="menu-wrap live_customizer bg_svg_blue">
    <nav class="menu">
        <div class="profile">
            <img src="http://via.placeholder.com/128x128" alt="Andrew"/>
            <span>Administrator</span>
        </div>
        <div class="link-list fixed-plugin">
            <div>
                <span class="fl">Dark Layout</span>
                <span>
                    <input type="checkbox" class="color_dark_settings"/>
                </span>
            </div>
            <div>
                <span class="fl">Enable Sidebar</span>
                <span>
                    <input type="checkbox" class="minified_switch_settings" checked/>
                </span>
            </div>
            <div>
                <span class="fl">Nav Bar Sticky</span>
                <span>
                    <input type="checkbox" class="minified_switch_nav_sticky"/>
                </span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="icon-list_bottom">
            <a href="javascript:void(0)"><i class="fa fa-fw fa-home"></i></a>
            <a href="javascript:void(0)"><i class="fa fa-fw fa-question-circle"></i></a>
            <a href="javascript:void(0)"><i class="fa fa-fw fa-power-off"></i></a>
        </div>
    </nav>
</div>
<!-- END LIVE CUSTOMIZER -->
                
@include('layouts.silverage.l_footer')