{{--

<header id="header"
        class="@if(!empty($is_home) or !empty($header_transparent))
            u-header u-header--abs-top u-header--white-nav-links-xl u-header--bg-transparent u-header--show-hide border-bottom border-xl-bottom-0 border-color-white
        @else
            header-white u-header u-header--dark-nav-links-xl u-header--show-hide-xl u-header--static-xl border-bottom
        @endif"
        data-header-fix-moment="500" data-header-fix-effect="slide">
    <div class="u-header__section u-header__shadow-on-show-hide">
        @include('Layout::parts.topbar')
        <div class="bravo_header">
            <div class="{{$container_class ?? 'container'}}">
                <div class="content">
                    <div class="header-left">
                        <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo navbar-brand u-header__navbar-brand-default u-header__navbar-brand-center u-header__navbar-brand-text-white mr-0 mr-xl-5">
                            @if($logo_id = setting_item("logo_id"))
                                <?php $logo = get_file_url($logo_id,'full') ?>
                                <img height="40" src="{{$logo}}" alt="{{setting_item("site_title")}}">
                            @endif
<!--                            <span class="u-header__navbar-brand-text">{{ setting_item_with_lang("logo_text") }}</span>-->
                        </a>
                        <a class="bravo-logo navbar-brand u-header__navbar-brand u-header__navbar-brand-center u-header__navbar-brand-on-scroll" href="{{url(app_get_locale(false,'/'))}}">
                            @if($logo_id = setting_item("logo_id_2"))
                                <?php $logo = get_file_url($logo_id,'full') ?>
                                <img height="40" src="{{$logo}}" alt="{{setting_item("site_title")}}">
                            @endif
<!--                            <span class="u-header__navbar-brand-text">{{ setting_item_with_lang("logo_text") }}</span>-->
                        </a>
                        <div class="bravo-menu">
                            <?php generate_menu('primary') ?>
                        </div>
                    </div>
                    <div class="header-right">
                        @if(!empty($header_right_menu))
                            <ul class="topbar-items">
                                @include('Core::frontend.currency-switcher')
                                @include('Language::frontend.switcher')
                                @if(!Auth::id())
                                    <li class="login-item">
                                        <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                                    </li>
                                    <li class="signup-item">
                                        <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                                    </li>
                                @else
                                    <li class="login-item dropdown">
                                        <a href="#" data-toggle="dropdown" class="is_login">
                                            @if($avatar_url = Auth::user()->getAvatarUrl())
                                                <img class="avatar" src="{{$avatar_url}}" alt="{{ Auth::user()->getDisplayName()}}">
                                            @else
                                                <span class="avatar-text">{{ucfirst( Auth::user()->getDisplayName()[0])}}</span>
                                            @endif
                                            {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu text-left">

                                            @if(Auth::user()->hasPermission('dashboard_vendor_access'))
                                                <li><a href="{{route('vendor.dashboard')}}"><i class="icon ion-md-analytics"></i> {{__("Vendor Dashboard")}}</a></li>
                                            @endif
                                            <li class="@if(Auth::user()->hasPermission('dashboard_vendor_access')) menu-hr @endif">
                                                <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a>
                                            </li>
                                            @if(setting_item('inbox_enable'))
                                                <li class="menu-hr"><a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Messages")}}</a></li>
                                            @endif
                                            <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Booking History")}}</a></li>
                                            <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>
                                            @if(Auth::user()->hasPermission('dashboard_access'))
                                                <li class="menu-hr"><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a></li>
                                            @endif
                                            <li class="menu-hr">
                                                <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                            </li>
                                        </ul>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        @endif
                        <button class="bravo-more-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="bravo-menu-mobile" style="display:none;">
                <div class="user-profile">
                    <div class="b-close"><i class="icofont-scroll-left"></i></div>
                    <div class="avatar"></div>
                    <ul>
                        @if(!Auth::id())
                            <li>
                                <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                            </li>
                            <li>
                                <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{route('user.profile.index')}}">
                                    <i class="icofont-user-suited"></i> {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('user.profile.index')}}">
                                    <i class="icon ion-md-construct"></i> {{__("My profile")}}
                                </a>
                            </li>
                            @if(Auth::user()->hasPermission('dashboard_access'))
                                <li>
                                    <a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Dashboard")}}</a>
                                </li>
                            @endif
                            <li>
                                <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                                    <i class="fa fa-sign-out"></i> {{__('Logout')}}
                                </a>
                                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                        @endif
                    </ul>
                    <ul class="multi-lang">
                        @include('Core::frontend.currency-switcher-dropdown')
                    </ul>
                    <ul class="multi-lang">
                        @include('Language::frontend.switcher-dropdown')
                    </ul>
                </div>
                <div class="g-menu">
                    <?php generate_menu('primary') ?>
                </div>
            </div>
        </div>
    </div>
</header>
--}}


<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
    <i class="icon_menu"></i>
</div>
<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="icon_close"></i>
    </div>

    <div class="header-configure-area">

        <a class="bk-btn" href="https://emaparking.co.uk/space">Book Now</a>
    </div>
    <nav class="mainmenu mobile-menu">
        <ul>
            <li class="@if(Route::is('home') || Route::is('index')) active @endif"><a href="/">Home</a></li>

            <li class="@if(Route::is('about')) active @endif"><a href="{{route('about')}}">About Us</a></li>
            <!--            <li><a href="./pages.html">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./room-details.html">Room Details</a></li>
                                <li><a href="#">Deluxe Room</a></li>
                                <li><a href="#">Family Room</a></li>
                                <li><a href="#">Premium Room</a></li>
                            </ul>
                        </li>-->
            <!--            <li><a href="#">News</a></li>-->
            <li class="@if(Route::is('contact.index')) active @endif"><a href="{{route('contact.index')}}">Contact</a></li>
            <li class="@if(Route::is('faq')) active @endif"><a href="{{route('faq')}}">FAQ</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="top-social">
        <a target="_blank" href="https://www.facebook.com/people/Midlands-Parking-Ltd/100092626675848/"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a target="_blank" href="https://www.youtube.com/@MidlandsParkingLtd"><i class="fa fa-youtube-play"></i></a>
        <a target="_blank" href="https://www.instagram.com/midlandsparkingltd/"><i class="fa fa-instagram"></i></a>
    </div>
    <ul class="top-widget">
        <!--        <li><i class="fa fa-phone"></i> +44 1234 67890</li>-->
        <li><i class="fa fa-envelope"></i><a href="mailto:support@emaparking.co.uk"> support@emaparking.co.uk<a></li>
    </ul>
</div>
<!-- Offcanvas Menu Section End -->

<!-- Header Section Begin -->
<header class="header-section">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="tn-left">
                        <!--                        <li><i class="fa fa-phone"></i> +44 1234 67890</li>-->
                        <li><i class="fa fa-envelope"></i> <a href="mailto:support@emaparking.co.uk">support@emaparking.co.uk</a></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="tn-right d-flex">
                        <div class="top-social">
                            <a target="_blank" href="https://www.facebook.com/people/Midlands-Parking-Ltd/100092626675848/"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a target="_blank" href="https://www.youtube.com/@MidlandsParkingLtd"><i class="fa fa-youtube-play"></i></a>
                            <a target="_blank" href="https://www.instagram.com/midlandsparkingltd/"><i class="fa fa-instagram"></i></a>
                        </div>
                        <a class="bk-btn" href="https://emaparking.co.uk/space">Book Now</a>
                        <div class="language-option">
                            <img alt="img" src="/home/img/flag.jpg">
                            <span>EN <i class="fa fa-angle-down"></i></span>
                            <div class="flag-dropdown">
                                <ul>
                                    <li><a href="#">Zi</a></li>
                                    <li><a href="#">Fr</a></li>
                                </ul>
                            </div>
                        </div>

                        @include('Layout::parts.notification')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="/">
                            <img alt="img" height="40" src="https://emaparking.co.uk/uploads/0000/1/2023/04/08/02.png">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 d-none d-lg-block">
                    <div class="nav-menu d-flex justify-content-end">
                        <nav class="mainmenu">
                            <ul>
                                <li class="@if(Route::is('home') || Route::is('index')) active @endif"><a href="/">Home</a></li>
                                <!--<li><a href="./rooms.html">Rooms</a></li>-->
                                <li class="@if(Route::is('about')) active @endif"><a href="{{route('about')}}">About Us</a></li>
                                <!--<li><a href="./pages.html">Pages</a>
                                    <ul class="dropdown">
                                        <li><a href="./room-details.html">Room Details</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                        <li><a href="#">Family Room</a></li>
                                        <li><a href="#">Premium Room</a></li>
                                    </ul>
                                </li>-->
                                <!--                                <li><a href="#">Blog</a></li>-->
                                <li class="@if(Route::is('contact.index')) active @endif"><a href="{{route('contact.index')}}">Contact</a></li>
                                <li class="@if(Route::is('faq')) active @endif"><a href="{{route('faq')}}">FAQ</a></li>
                            </ul>
                        </nav>
                        @if(!Auth::id())
                            <div class="nav-right d-flex justify-content-center search-switch u-header__login-form dropdown-connector-xl u-header__topbar-divider py-0">
                                <a href="javascript:;" class="d-flex align-items-center justify-content-center" style="margin-top: 10px" data-toggle="modal" data-target="#login">
                                    <i class="flaticon-040-key-card flaticon-nav"></i>
                                    <span class="d-inline-block text-dark font-size-14 ml-2" style="margin-top: -10px">Sign in or Register</span>
                                </a>
                            </div>
                        @else
                            <div class="d-flex align-items-center py-3">
                                <i class="flaticon-user-2 mr-2 ml-1 font-size-18"></i>
                                <span class="d-inline-block font-size-14 mr-1 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{__("Hi, :name",['name'=>Auth::user()->getDisplayName()])}}
                                </span>

                                <ul class="dropdown-menu bg-dark">
                                    {{--@if(empty( setting_item('wallet_module_disable') ))
                                        <li class="credit_amount">
                                            <a href="{{route('user.wallet')}}"><i class="fa fa-money"></i> {{__("Credit: :amount",['amount'=>auth()->user()->balance])}}</a>
                                        </li>
                                    @endif--}}
                                    @if(!is_admin() && is_vendor())
                                        <li class=""><a href="{{route('vendor.dashboard')}}" class="dropdown-item"><i class="icon ion-md-analytics"></i> {{__("Dashboard")}}</a></li>
                                    @endif
                                    @if(is_admin())
                                        <li class="dropdown-item"><a href="{{url('/admin')}}"><i class="icon ion-md-analytics"></i> {{__("Admin Dashboard")}}</a></li>
                                    @endif
                                    <li class="@if(is_vendor())  @endif dropdown-item">
                                        <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a>
                                    </li>
                                    @if(setting_item('inbox_enable'))
                                        <li class="dropdown-item"><a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Messages")}}</a></li>
                                    @endif
                                    <li class="dropdown-item"><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Booking History")}}</a></li>
                                    <li class="dropdown-item"><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>

                                    <li class="dropdown-item">
                                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                    </li>
                                </ul>
                                <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        @endif
                        <!--<div class="nav-right search-switch">
                            <i class="icon_search"></i>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
