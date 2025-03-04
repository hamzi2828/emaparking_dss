<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php event(new \Modules\Layout\Events\LayoutBeginHead()); @endphp
<!--    <meta content="Sona Template" name="description">
    <meta content="Sona, unica, creative, html" name="keywords">-->
    @include('Layout::parts.seo-meta')


    @php
        $favicon = setting_item('site_favicon');
    @endphp
    @if($favicon)
        @php
            $file = (new \Modules\Media\Models\MediaFile())->findById($favicon);
        @endphp
        @if(!empty($file))
            <link rel="icon" type="{{$file['file_type']}}" href="{{asset('uploads/'.$file['file_path'])}}" />
        @else:
        <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />
        @endif
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cdbootstrap/css/cdb.min.css"/>
    <link href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('themes/mytravel/libs/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/mytravel/libs/slick/slick.css') }}?v=1" rel="stylesheet">
    <link href="{{ asset('themes/mytravel/libs/custombox/custombox.min.css') }}" rel="stylesheet">

    <link href="{{ asset('themes/mytravel/dist/frontend/css/notification.css') }}" rel="newest stylesheet">
    <link href="{{ asset('themes/mytravel/dist/frontend/css/app.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{ asset("libs/daterange/daterangepicker.css") }}?v=1" >
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Rubik:300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('themes/mytravel/libs/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link href="{{ asset('libs/ion_rangeslider/css/ion.rangeSlider.css') }}?v=1" rel="stylesheet">
    <meta name="p:domain_verify" content="4bc8a2fce7af10cd75d61f9029218798"/>

    {!! \App\Helpers\Assets::css() !!}
    {!! \App\Helpers\Assets::js() !!}
    @include('Layout::parts.global-script')
    <!-- Styles -->
    @livewireStyles
    @stack('css')
    {{--Custom Style--}}
    <link href="{{ route('core.style.customCss') }}" rel="stylesheet">
    <link href="{{ asset('libs/carousel-2/owl.carousel.css') }}" rel="stylesheet">
    @if(setting_item_with_lang('enable_rtl'))
        <link href="{{ asset('themes/mytravel/dist/frontend/css/rtl.css?_v='.config('app.asset_version')) }}" rel="stylesheet">
    @endif
    {!! setting_item('head_scripts') !!}
    {!! setting_item_with_lang_raw('head_scripts') !!}



    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
<!--    <link href="/home/css/bootstrap.min.css" rel="stylesheet" type="text/css">-->
    <link href="/home/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/home/css/elegant-icons.css" rel="stylesheet" type="text/css">
    <link href="/home/css/flaticon.css?v=1" rel="stylesheet" type="text/css">
    <link href="/home/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
    <link href="/home/css/nice-select.css" rel="stylesheet" type="text/css">
    <link href="/home/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="/home/css/magnific-popup.css?v=1" rel="stylesheet" type="text/css">
    <link href="/home/css/slicknav.min.css" rel="stylesheet" type="text/css">
    <link href="/home/css/style.css?v=1" rel="stylesheet" type="text/css">

    <style>
        a:hover {
            color: black;
        }
          .hero-sliderimagecss
        {
            background-color: rgb(0 0 0 / 25%);
            background-blend-mode: overlay
            
        }
        
    </style>
        
    @php event(new \Modules\Layout\Events\LayoutEndHead()); @endphp
    <script type="application/ld+json">
        {
         "@context": "https://schema.org/",
         "@type": "WebPage",
         "name": "EMA Parking",
         "speakable":
         {
          "@type": "SpeakableSpecification",
          "xPath": [
            "/html/head/title",
            "/html/head/meta[@name='description']/@content"
            ]
          },
         "url": "{{$seo_meta['full_url'] ?? ""}}"
         }
     </script>
     <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "Organization",
          "name": "Midlands Parking Ltd",
          "url": "https://emaparking.co.uk",
          "logo": "https://emaparking.co.uk/uploads/0000/1/2023/04/08/02.png",
          "contactPoint": {
            "@type": "ContactPoint",
            "email": "support@emaparking.co.uk",
            "contactType": "Customer Service"
          },
          "sameAs": [
            "https://www.facebook.com/midlandsparking",
            "https://twitter.com/midlandsparking"
          ]
        }
        </script>
        @stack('tagscript')
</head>

<body>
@php event(new \Modules\Layout\Events\LayoutBeginBody()); @endphp
{!! setting_item('body_scripts') !!}
{!! setting_item_with_lang_raw('body_scripts') !!}
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader   "></div>
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
        <li><i class="fa fa-envelope"></i>  <a href="mailto:support@emaparking.co.uk">support@emaparking.co.uk</a></li>
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
                        <li><i class="fa fa-envelope"></i><a href="mailto:support@emaparking.co.uk">support@emaparking.co.uk</a></li>
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
@yield('content')


<!-- Footer Section End -->

<!-- Search model Begin -->
<!--<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>-->
@include('Layout::parts.footer')
<!-- Search model end -->
{!! setting_item('footer_scripts') !!}
{!! setting_item_with_lang_raw('footer_scripts') !!}

<!-- Js Plugins -->
@stack('js')
@php event(new \Modules\Layout\Events\LayoutEndBody()); @endphp
</body>

</html>
