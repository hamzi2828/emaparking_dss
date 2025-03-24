<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php($favicon = setting_item('site_favicon'))
    <link rel="icon" type="image/png" href="{{!empty($favicon)?get_file_url($favicon,'full'):url('images/favicon.png')}}" />
    @include('Layout::parts.seo-meta')
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="/user/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/user/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/user/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    @include('Layout::parts.global-script')
    <!-- Styles -->
    <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5em;
            z-index: 1; /* Ensure overlay is above the content */
        }
    </style>
    @stack('css')
</head>
<body id="kt_body" style="background-image: url(/user/assets/media/patterns/header-bg.png)" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <!--begin::Main-->

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                @include('layouts.userDashboard.header')
                <!--end::Header-->
                <!--begin::Toolbar-->
                <div class="toolbar py-5 py-lg-15 pb-lg-2" id="kt_toolbar">
                    <!--begin::Container-->
                    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
                        <!--begin::Title-->
                        <h3 class="text-white fw-bolder fs-2qx me-5">@yield('pageTitle')</h3>
                        <!--begin::Title-->
                        <!--begin::Actions-->
                        <div class="d-flex align-items-center flex-wrap py-2">
                            <!--begin::Search-->
                            <!--<div id="kt_header_search" class="d-flex align-items-center w-200px w-lg-250px my-2 me-4 me-lg-6" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
                                &lt;!&ndash;begin::Form&ndash;&gt;
                                <form data-kt-search-element="form" class="search w-100 position-relative" autocomplete="off">
                                    &lt;!&ndash;begin::Hidden input(Added to disable form autocomplete)&ndash;&gt;
                                    <input type="hidden" />
                                    &lt;!&ndash;end::Hidden input&ndash;&gt;
                                    &lt;!&ndash;begin::Icon&ndash;&gt;
                                    &lt;!&ndash;begin::Svg Icon | path: icons/duotune/general/gen021.svg&ndash;&gt;
                                    <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-white position-absolute top-50 translate-middle-y ms-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                        </svg>
                                    </span>
                                    &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                    &lt;!&ndash;end::Icon&ndash;&gt;
                                    &lt;!&ndash;begin::Input&ndash;&gt;
                                    <input type="text" class="form-control ps-15" name="search" value="" placeholder="Search..." data-kt-search-element="input" />
                                    &lt;!&ndash;end::Input&ndash;&gt;
                                    &lt;!&ndash;begin::Spinner&ndash;&gt;
                                    <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                                        <span class="spinner-border h-15px w-15px align-middle text-white"></span>
                                    </span>
                                    &lt;!&ndash;end::Spinner&ndash;&gt;
                                    &lt;!&ndash;begin::Reset&ndash;&gt;
                                    <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
                                        &lt;!&ndash;begin::Svg Icon | path: icons/duotune/arrows/arr061.svg&ndash;&gt;
                                        <span class="svg-icon svg-icon-2 svg-icon-white svg-icon-lg-1 me-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                            </svg>
                                        </span>
                                        &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                    </span>
                                    &lt;!&ndash;end::Reset&ndash;&gt;
                                </form>
                                &lt;!&ndash;end::Form&ndash;&gt;
                                &lt;!&ndash;begin::Menu&ndash;&gt;
                                <div data-kt-search-element="content" class="menu menu-sub menu-sub-dropdown w-300px w-md-400px py-7 px-7 overflow-hidden">
                                    &lt;!&ndash;begin::Wrapper&ndash;&gt;
                                    <div data-kt-search-element="wrapper">
                                        &lt;!&ndash;begin::Categories&ndash;&gt;
                                        <div data-kt-search-element="categories" class="d-flex overflow-auto position-relative" data-kt-buttons="true">
                                            &lt;!&ndash;begin::Category items&ndash;&gt;
                                            <a class="btn btn-light-primary active rounded-pill me-1 py-2 px-4" data-kt-search-category="all">All</a>
                                            <a class="btn btn-light-primary rounded-pill me-1 py-2 px-4" data-kt-search-category="targets">Targets</a>
                                            <a class="btn btn-light-primary rounded-pill me-1 py-2 px-4" data-kt-search-category="projects">Projects</a>
                                            <a class="btn btn-light-primary rounded-pill me-1 py-2 px-4" data-kt-search-category="users">Users</a>
                                            &lt;!&ndash;end::Category items&ndash;&gt;
                                            &lt;!&ndash;begin::Preferences toggle&ndash;&gt;
                                            <div data-kt-search-element="preferences-show" class="btn btn-icon btn-sm btn-active-color-primary ms-auto">
                                                &lt;!&ndash;begin::Svg Icon | path: icons/duotune/general/gen023.svg&ndash;&gt;
                                                <span class="svg-icon svg-icon-2x">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black" />
                                                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
                                                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
                                                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
                                                    </svg>
                                                </span>
                                                &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                            </div>
                                            &lt;!&ndash;end::Preferences toggle&ndash;&gt;
                                        </div>
                                        &lt;!&ndash;end::Categories&ndash;&gt;
                                        &lt;!&ndash;begin::Separator&ndash;&gt;
                                        <div class="separator border-gray-200 my-6"></div>
                                        &lt;!&ndash;end::Separator&ndash;&gt;
                                        &lt;!&ndash;begin::Recently viewed&ndash;&gt;
                                        <div data-kt-search-element="results" class="d-none">
                                            &lt;!&ndash;begin::Items&ndash;&gt;
                                            <div class="scroll-y mh-200px mh-lg-300px my-2 me-n2 pe-2">
                                                &lt;!&ndash;begin::Category title&ndash;&gt;
                                                <h3 class="fs-4 fw-bold m-0 pb-5" data-kt-search-element="category-title">Targets</h3>
                                                &lt;!&ndash;end::Category title&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="targets">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light">
                                                            <img class="w-20px h-20px" src="assets/media/svg/brand-logos/volicity-9.svg" alt="" />
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Company Rbranding</span>
                                                        <span class="badge badge-light">UI Design</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="targets">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light">
                                                            <img class="w-20px h-20px" src="assets/media/svg/brand-logos/tvit.svg" alt="" />
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Company Re-branding</span>
                                                        <span class="badge badge-light">Web Development</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="targets">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light">
                                                            <img class="w-20px h-20px" src="assets/media/svg/misc/infography.svg" alt="" />
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Business Analytics App</span>
                                                        <span class="badge badge-light">Administration</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="targets">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light">
                                                            <img class="w-20px h-20px" src="assets/media/svg/brand-logos/atica.svg" alt="" />
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">5G Mobile Billing</span>
                                                        <span class="badge badge-light">Database Design</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="targets">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light">
                                                            <img class="w-20px h-20px" src="assets/media/svg/brand-logos/rgb.svg" alt="" />
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">UI/UX Conference</span>
                                                        <span class="badge badge-light">Server Setup</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="targets">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light">
                                                            <img class="w-20px h-20px" src="assets/media/svg/brand-logos/leaf.svg" alt="" />
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">EcoLeaf App Launch</span>
                                                        <span class="badge badge-light">Marketing</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="targets">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light">
                                                            <img class="w-20px h-20px" src="assets/media/svg/brand-logos/tower.svg" alt="" />
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Tower Group Website</span>
                                                        <span class="badge badge-light">Google Adwords</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Category title&ndash;&gt;
                                                <h3 class="fs-4 fw-bold m-0 pt-10 pb-5" data-kt-search-element="category-title">Projects</h3>
                                                &lt;!&ndash;end::Category title&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="projects">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/general/gen005.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z" fill="black" />
                                                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Si-Fi Project by AU Themes</span>
                                                        <span class="fs-7 text-muted">#45670</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="projects">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/finance/fin008.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="black" />
                                                                    <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="black" />
                                                                    <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">"Create FireStone API" Target</span>
                                                        <span class="fs-7 text-muted">#84250</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="projects">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
                                                                    <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
                                                                    <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Reference to "FureStibe" Project FAQ</span>
                                                        <span class="fs-7 text-muted">#67945</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="projects">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/general/gen006.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="black" />
                                                                    <path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">"Landing UI Design" Project Launch</span>
                                                        <span class="fs-7 text-muted">#24005</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="projects">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/general/gen032.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                                                                    <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                                                                    <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                                                                    <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Shopix Mobile App Planning</span>
                                                        <span class="fs-7 text-muted">#45690</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="projects">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/communication/com012.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black" />
                                                                    <rect x="6" y="12" width="7" height="2" rx="1" fill="black" />
                                                                    <rect x="6" y="7" width="12" height="2" rx="1" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Finance Monitoring SAAS Discussion</span>
                                                        <span class="fs-7 text-muted">#21090</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="projects">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/communication/com006.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Dashboard Analitics Launch</span>
                                                        <span class="fs-7 text-muted">#34560</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Category title&ndash;&gt;
                                                <h3 class="fs-4 fw-bold m-0 pt-10 pb-5" data-kt-search-element="category-title">Users</h3>
                                                &lt;!&ndash;end::Category title&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="users">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <img src="assets/media/avatars/150-1.jpg" alt="" />
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Karina Clark</span>
                                                        <span class="badge badge-light">Marketing Manager</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="users">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <img src="assets/media/avatars/150-3.jpg" alt="" />
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Olivia Bold</span>
                                                        <span class="badge badge-light">Software Engineer</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="users">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <img src="assets/media/avatars/150-4.jpg" alt="" />
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Sean Wild</span>
                                                        <span class="badge badge-light">Web Developer</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="users">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <img src="assets/media/avatars/150-6.jpg" alt="" />
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Karina Clark</span>
                                                        <span class="badge badge-light">Google Expert</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="users">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <img src="assets/media/avatars/150-8.jpg" alt="" />
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Ana Clark</span>
                                                        <span class="badge badge-light">UI/UX Designer</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="users">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <img src="assets/media/avatars/150-11.jpg" alt="" />
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Nick Pitola</span>
                                                        <span class="badge badge-light">Art Director</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1" data-kt-search-category="users">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <img src="assets/media/avatars/150-12.jpg" alt="" />
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800 me-2">Edward Kulnic</span>
                                                        <span class="badge badge-light">System Administrator</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                            </div>
                                            &lt;!&ndash;end::Items&ndash;&gt;
                                        </div>
                                        &lt;!&ndash;end::Recently viewed&ndash;&gt;
                                        &lt;!&ndash;begin::Recently viewed&ndash;&gt;
                                        <div data-kt-search-element="recently-viewed">
                                            &lt;!&ndash;begin::Heading&ndash;&gt;
                                            <div class="d-flex flex-stack fw-bold">
                                                <span class="text-muted fs-5 me-2">Recently Viewed:</span>
                                                &lt;!&ndash;begin::Clear&ndash;&gt;
                                                <div data-kt-search-element="recently-viewed-clear" class="btn btn-link fw-6">Clear</div>
                                                &lt;!&ndash;end::Clear&ndash;&gt;
                                            </div>
                                            &lt;!&ndash;end::Heading&ndash;&gt;
                                            &lt;!&ndash;begin::Items&ndash;&gt;
                                            <div class="scroll-y mh-200px mh-lg-300px my-2 me-n2 pe-2">
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/general/gen005.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z" fill="black" />
                                                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Si-Fi Project by AU Themes</span>
                                                        <span class="fs-7 text-muted">#45670</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/finance/fin008.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="black" />
                                                                    <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="black" />
                                                                    <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">"Create FireStone API" Target</span>
                                                        <span class="fs-7 text-muted">#84250</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
                                                                    <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
                                                                    <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Reference to "FureStibe" Project FAQ</span>
                                                        <span class="fs-7 text-muted">#67945</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/general/gen006.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="black" />
                                                                    <path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">"Landing UI Design" Project Launch</span>
                                                        <span class="fs-7 text-muted">#24005</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/general/gen032.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                                                                    <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                                                                    <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                                                                    <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Shopix Mobile App Planning</span>
                                                        <span class="fs-7 text-muted">#45690</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/communication/com012.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black" />
                                                                    <rect x="6" y="12" width="7" height="2" rx="1" fill="black" />
                                                                    <rect x="6" y="7" width="12" height="2" rx="1" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Finance Monitoring SAAS Discussion</span>
                                                        <span class="fs-7 text-muted">#21090</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                                &lt;!&ndash;begin::Item&ndash;&gt;
                                                <a href="#" class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                    &lt;!&ndash;begin::Symbol&ndash;&gt;
                                                    <div class="symbol symbol-30px me-4">
                                                        <span class="symbol-label bg-light-primary">
                                                            &lt;!&ndash;begin::Svg Icon | path: icons/duotune/communication/com006.svg&ndash;&gt;
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                        </span>
                                                    </div>
                                                    &lt;!&ndash;end::Symbol&ndash;&gt;
                                                    &lt;!&ndash;begin::Title&ndash;&gt;
                                                    <div class="fw-bold">
                                                        <span class="fs-6 text-gray-800">Dashboard Analitics Launch</span>
                                                        <span class="fs-7 text-muted">#34560</span>
                                                    </div>
                                                    &lt;!&ndash;end::Title&ndash;&gt;
                                                </a>
                                                &lt;!&ndash;end::Item&ndash;&gt;
                                            </div>
                                            &lt;!&ndash;end::Items&ndash;&gt;
                                        </div>
                                        &lt;!&ndash;end::Recently viewed&ndash;&gt;
                                        &lt;!&ndash;begin::Empty&ndash;&gt;
                                        <div data-kt-search-element="empty" class="text-center d-none">
                                            &lt;!&ndash;begin::Message&ndash;&gt;
                                            <div class="text-muted fw-bold fs-5 py-10">No result found</div>
                                            &lt;!&ndash;end::Message&ndash;&gt;
                                            &lt;!&ndash;begin::Illustration&ndash;&gt;
                                            <div class="text-center px-4">
                                                <img src="assets/media/illustrations/dozzy-1/2.png" alt="" class="w-100 h-200px" />
                                            </div>
                                            &lt;!&ndash;end::Illustration&ndash;&gt;
                                        </div>
                                        &lt;!&ndash;end::Empty&ndash;&gt;
                                    </div>
                                    &lt;!&ndash;end::Wrapper&ndash;&gt;
                                    &lt;!&ndash;begin::Preferences&ndash;&gt;
                                    <div data-kt-search-element="preferences" class="d-none">
                                        &lt;!&ndash;begin::Heading&ndash;&gt;
                                        <h3 class="fw-bold text-dark pb-10 m-0">Search Preferences</h3>
                                        &lt;!&ndash;end::Heading&ndash;&gt;
                                        &lt;!&ndash;begin::Input group&ndash;&gt;
                                        <div class="pb-4 border-bottom">
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid justify-content-between">
                                                <span class="form-check-label text-gray-700 fs-5 fw-bold ms-0 me-2">Projects</span>
                                                <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                            </label>
                                        </div>
                                        &lt;!&ndash;end::Input group&ndash;&gt;
                                        &lt;!&ndash;begin::Input group&ndash;&gt;
                                        <div class="py-4 border-bottom">
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid justify-content-between">
                                                <span class="form-check-label text-gray-700 fs-5 fw-bold ms-0 me-2">Targets</span>
                                                <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                            </label>
                                        </div>
                                        &lt;!&ndash;end::Input group&ndash;&gt;
                                        &lt;!&ndash;begin::Input group&ndash;&gt;
                                        <div class="py-4 border-bottom">
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid justify-content-between">
                                                <span class="form-check-label text-gray-700 fs-5 fw-bold ms-0 me-2">Affiliate Programs</span>
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </label>
                                        </div>
                                        &lt;!&ndash;end::Input group&ndash;&gt;
                                        &lt;!&ndash;begin::Input group&ndash;&gt;
                                        <div class="py-4 border-bottom">
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid justify-content-between">
                                                <span class="form-check-label text-gray-700 fs-5 fw-bold ms-0 me-2">Referrals</span>
                                                <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                            </label>
                                        </div>
                                        &lt;!&ndash;end::Input group&ndash;&gt;
                                        &lt;!&ndash;begin::Input group&ndash;&gt;
                                        <div class="py-4 border-bottom">
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid justify-content-between">
                                                <span class="form-check-label text-gray-700 fs-5 fw-bold ms-0 me-2">Users</span>
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </label>
                                        </div>
                                        &lt;!&ndash;end::Input group&ndash;&gt;
                                        &lt;!&ndash;begin::Actions&ndash;&gt;
                                        <div class="d-flex justify-content-end pt-10">
                                            <button type="reset" class="btn btn-white btn-active-light-primary me-2 px-6" data-kt-search-element="preferences-dismiss">Cancel</button>
                                            <button type="submit" class="btn btn-primary px-6">Save Changes</button>
                                        </div>
                                        &lt;!&ndash;end::Actions&ndash;&gt;
                                    </div>
                                    &lt;!&ndash;end::Preferences&ndash;&gt;
                                </div>
                                &lt;!&ndash;end::Menu&ndash;&gt;
                            </div>-->
                            <!--end::Search-->
                            <!--begin::Action-->
                            <a href="{{route('user.referrals')}}" class="btn btn-custom btn-color-white btn-active-color-success my-2 me-2 me-lg-6" >Invite Friend</a>
                            <!--end::Action-->
                            <!--begin::Button-->
                            <a href="/" class="btn btn-success my-2">New Booking</a>
                            <!--end::Button-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Container-->
                @yield('content')
                <!--end::Container-->
                <!--begin::Footer-->
                @include('layouts.userDashboard.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    <!--begin::Activities drawer-->
    <div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '900px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">
        <div class="card shadow-none rounded-0" style="position: relative">
            <!--begin::Header-->
            <div class="card-header" id="kt_activities_header">
                <h3 class="card-title fw-bolder text-dark">Activity Logs</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
                        <!--end::Svg Icon-->
                    </button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body position-relative" id="kt_activities_body">
                <!--begin::Content-->
                <div id="kt_activities_scroll" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body" data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" data-kt-scroll-offset="5px">
                    <!--begin::Timeline items-->
                    <div class="timeline">
                        <!--begin::Timeline item-->
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line w-40px"></div>
                            <!--end::Timeline line-->
                            <!--begin::Timeline icon-->
                            <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                <div class="symbol-label bg-light">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black" />
												<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black" />
											</svg>
										</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Timeline icon-->
                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="pe-3 mb-5">
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">There are 2 new tasks for you in “AirPlus Mobile APp” project:</div>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="text-muted me-2 fs-7">Added at 4:23 PM by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
                                            <img src="assets/media/avatars/150-11.jpg" alt="img" />
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                                <!--begin::Timeline details-->
                                <div class="overflow-auto pb-5">
                                    <!--begin::Record-->
                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 text-dark text-hover-primary fw-bold w-375px min-w-200px">Meeting with customer</a>
                                        <!--end::Title-->
                                        <!--begin::Label-->
                                        <div class="min-w-175px pe-2">
                                            <span class="badge badge-light text-muted">Application Design</span>
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Users-->
                                        <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2">
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px">
                                                <img src="assets/media/avatars/150-3.jpg" alt="img" />
                                            </div>
                                            <!--end::User-->
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px">
                                                <img src="assets/media/avatars/150-11.jpg" alt="img" />
                                            </div>
                                            <!--end::User-->
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px">
                                                <div class="symbol-label fs-8 fw-bold bg-primary text-inverse-primary">A</div>
                                            </div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Users-->
                                        <!--begin::Progress-->
                                        <div class="min-w-125px pe-2">
                                            <span class="badge badge-light-primary">In Progress</span>
                                        </div>
                                        <!--end::Progress-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Record-->
                                    <!--begin::Record-->
                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-0">
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 text-dark text-hover-primary fw-bold w-375px min-w-200px">Project Delivery Preparation</a>
                                        <!--end::Title-->
                                        <!--begin::Label-->
                                        <div class="min-w-175px">
                                            <span class="badge badge-light text-muted">CRM System Development</span>
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Users-->
                                        <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px">
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px">
                                                <img src="assets/media/avatars/150-5.jpg" alt="img" />
                                            </div>
                                            <!--end::User-->
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px">
                                                <div class="symbol-label fs-8 fw-bold bg-success text-inverse-primary">B</div>
                                            </div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Users-->
                                        <!--begin::Progress-->
                                        <div class="min-w-125px">
                                            <span class="badge badge-light-success">Completed</span>
                                        </div>
                                        <!--end::Progress-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Record-->
                                </div>
                                <!--end::Timeline details-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        <!--end::Timeline item-->
                        <!--begin::Timeline item-->
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line w-40px"></div>
                            <!--end::Timeline line-->
                            <!--begin::Timeline icon-->
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com009.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M5.78001 21.115L3.28001 21.949C3.10897 22.0059 2.92548 22.0141 2.75004 21.9727C2.57461 21.9312 2.41416 21.8418 2.28669 21.7144C2.15923 21.5869 2.06975 21.4264 2.0283 21.251C1.98685 21.0755 1.99507 20.892 2.05201 20.7209L2.886 18.2209L7.22801 13.879L10.128 16.774L5.78001 21.115Z" fill="black" />
												<path d="M21.7 8.08899L15.911 2.30005C15.8161 2.2049 15.7033 2.12939 15.5792 2.07788C15.455 2.02637 15.3219 1.99988 15.1875 1.99988C15.0531 1.99988 14.92 2.02637 14.7958 2.07788C14.6717 2.12939 14.5589 2.2049 14.464 2.30005L13.74 3.02295C13.548 3.21498 13.4402 3.4754 13.4402 3.74695C13.4402 4.01849 13.548 4.27892 13.74 4.47095L14.464 5.19397L11.303 8.35498C10.1615 7.80702 8.87825 7.62639 7.62985 7.83789C6.38145 8.04939 5.2293 8.64265 4.332 9.53601C4.14026 9.72817 4.03256 9.98855 4.03256 10.26C4.03256 10.5315 4.14026 10.7918 4.332 10.984L13.016 19.667C13.208 19.859 13.4684 19.9668 13.74 19.9668C14.0115 19.9668 14.272 19.859 14.464 19.667C15.3575 18.77 15.9509 17.618 16.1624 16.3698C16.374 15.1215 16.1932 13.8383 15.645 12.697L18.806 9.53601L19.529 10.26C19.721 10.452 19.9814 10.5598 20.253 10.5598C20.5245 10.5598 20.785 10.452 20.977 10.26L21.7 9.53601C21.7952 9.44108 21.8706 9.32825 21.9221 9.2041C21.9737 9.07995 22.0002 8.94691 22.0002 8.8125C22.0002 8.67809 21.9737 8.54505 21.9221 8.4209C21.8706 8.29675 21.7952 8.18392 21.7 8.08899Z" fill="black" />
											</svg>
										</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Timeline icon-->
                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n2">
                                <!--begin::Timeline heading-->
                                <div class="overflow-auto pe-3">
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">Invitation for crafting engaging designs that speak human workshop</div>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="text-muted me-2 fs-7">Sent at 4:23 PM by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Alan Nilson">
                                            <img src="assets/media/avatars/150-2.jpg" alt="img" />
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        <!--end::Timeline item-->
                        <!--begin::Timeline item-->
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line w-40px"></div>
                            <!--end::Timeline line-->
                            <!--begin::Timeline icon-->
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light">
                                    <!--begin::Svg Icon | path: icons/duotune/coding/cod008.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M11.2166 8.50002L10.5166 7.80007C10.1166 7.40007 10.1166 6.80005 10.5166 6.40005L13.4166 3.50002C15.5166 1.40002 18.9166 1.50005 20.8166 3.90005C22.5166 5.90005 22.2166 8.90007 20.3166 10.8001L17.5166 13.6C17.1166 14 16.5166 14 16.1166 13.6L15.4166 12.9C15.0166 12.5 15.0166 11.9 15.4166 11.5L18.3166 8.6C19.2166 7.7 19.1166 6.30002 18.0166 5.50002C17.2166 4.90002 16.0166 5.10007 15.3166 5.80007L12.4166 8.69997C12.2166 8.89997 11.6166 8.90002 11.2166 8.50002ZM11.2166 15.6L8.51659 18.3001C7.81659 19.0001 6.71658 19.2 5.81658 18.6C4.81658 17.9 4.71659 16.4 5.51659 15.5L8.31658 12.7C8.71658 12.3 8.71658 11.7001 8.31658 11.3001L7.6166 10.6C7.2166 10.2 6.6166 10.2 6.2166 10.6L3.6166 13.2C1.7166 15.1 1.4166 18.1 3.1166 20.1C5.0166 22.4 8.51659 22.5 10.5166 20.5L13.3166 17.7C13.7166 17.3 13.7166 16.7001 13.3166 16.3001L12.6166 15.6C12.3166 15.2 11.6166 15.2 11.2166 15.6Z" fill="black" />
												<path opacity="0.3" d="M5.0166 9L2.81659 8.40002C2.31659 8.30002 2.0166 7.79995 2.1166 7.19995L2.31659 5.90002C2.41659 5.20002 3.21659 4.89995 3.81659 5.19995L6.0166 6.40002C6.4166 6.60002 6.6166 7.09998 6.5166 7.59998L6.31659 8.30005C6.11659 8.80005 5.5166 9.1 5.0166 9ZM8.41659 5.69995H8.6166C9.1166 5.69995 9.5166 5.30005 9.5166 4.80005L9.6166 3.09998C9.6166 2.49998 9.2166 2 8.5166 2H7.81659C7.21659 2 6.71659 2.59995 6.91659 3.19995L7.31659 4.90002C7.41659 5.40002 7.91659 5.69995 8.41659 5.69995ZM14.6166 18.2L15.1166 21.3C15.2166 21.8 15.7166 22.2 16.2166 22L17.6166 21.6C18.1166 21.4 18.4166 20.8 18.1166 20.3L16.7166 17.5C16.5166 17.1 16.1166 16.9 15.7166 17L15.2166 17.1C14.8166 17.3 14.5166 17.7 14.6166 18.2ZM18.4166 16.3L19.8166 17.2C20.2166 17.5 20.8166 17.3 21.0166 16.8L21.3166 15.9C21.5166 15.4 21.1166 14.8 20.5166 14.8H18.8166C18.0166 14.8 17.7166 15.9 18.4166 16.3Z" fill="black" />
											</svg>
										</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Timeline icon-->
                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="mb-5 pe-3">
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">3 New Incoming Project Files:</a>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="text-muted me-2 fs-7">Sent at 10:30 PM by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Jan Hummer">
                                            <img src="assets/media/avatars/150-6.jpg" alt="img" />
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                                <!--begin::Timeline details-->
                                <div class="overflow-auto pb-5">
                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-5">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                                            <!--begin::Icon-->
                                            <img alt="" class="w-30px me-3" src="assets/media/svg/files/pdf.svg" />
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <div class="ms-1 fw-bold">
                                                <!--begin::Desc-->
                                                <a href="#" class="fs-6 text-hover-primary fw-bolder">Finance KPI App Guidelines</a>
                                                <!--end::Desc-->
                                                <!--begin::Number-->
                                                <div class="text-gray-400">1.9mb</div>
                                                <!--end::Number-->
                                            </div>
                                            <!--begin::Info-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                                            <!--begin::Icon-->
                                            <img alt="" class="w-30px me-3" src="assets/media/svg/files/doc.svg" />
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <div class="ms-1 fw-bold">
                                                <!--begin::Desc-->
                                                <a href="#" class="fs-6 text-hover-primary fw-bolder">Client UAT Testing Results</a>
                                                <!--end::Desc-->
                                                <!--begin::Number-->
                                                <div class="text-gray-400">18kb</div>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-aligns-center">
                                            <!--begin::Icon-->
                                            <img alt="" class="w-30px me-3" src="assets/media/svg/files/css.svg" />
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <div class="ms-1 fw-bold">
                                                <!--begin::Desc-->
                                                <a href="#" class="fs-6 text-hover-primary fw-bolder">Finance Reports</a>
                                                <!--end::Desc-->
                                                <!--begin::Number-->
                                                <div class="text-gray-400">20mb</div>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Icon-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                </div>
                                <!--end::Timeline details-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        <!--end::Timeline item-->
                        <!--begin::Timeline item-->
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line w-40px"></div>
                            <!--end::Timeline line-->
                            <!--begin::Timeline icon-->
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black" />
												<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black" />
											</svg>
										</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Timeline icon-->
                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="pe-3 mb-5">
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">Task
                                        <a href="#" class="text-primary fw-bolder me-1">#45890</a>merged with
                                        <a href="#" class="text-primary fw-bolder me-1">#45890</a>in “Ads Pro Admin Dashboard project:</div>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="text-muted me-2 fs-7">Initiated at 4:23 PM by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
                                            <img src="assets/media/avatars/150-11.jpg" alt="img" />
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        <!--end::Timeline item-->
                        <!--begin::Timeline item-->
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line w-40px"></div>
                            <!--end::Timeline line-->
                            <!--begin::Timeline icon-->
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
												<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
											</svg>
										</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Timeline icon-->
                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="pe-3 mb-5">
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">3 new application design concepts added:</div>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="text-muted me-2 fs-7">Created at 4:23 PM by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Marcus Dotson">
                                            <img src="assets/media/avatars/150-3.jpg" alt="img" />
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                                <!--begin::Timeline details-->
                                <div class="overflow-auto pb-5">
                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-7">
                                        <!--begin::Item-->
                                        <div class="overlay me-10">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper">
                                                <img alt="img" class="rounded w-100px" src="assets/media/stock/300x270/1.jpg" />
                                            </div>
                                            <!--end::Image-->
                                            <!--begin::Link-->
                                            <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                                <a href="#" class="btn btn-sm btn-primary btn-shadow">Explore</a>
                                            </div>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="overlay me-10">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper">
                                                <img alt="img" class="rounded w-100px" src="assets/media/stock/300x270/2.jpg" />
                                            </div>
                                            <!--end::Image-->
                                            <!--begin::Link-->
                                            <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                                <a href="#" class="btn btn-sm btn-primary btn-shadow">Explore</a>
                                            </div>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="overlay">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper">
                                                <img alt="img" class="rounded w-100px" src="assets/media/stock/300x270/3.jpg" />
                                            </div>
                                            <!--end::Image-->
                                            <!--begin::Link-->
                                            <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                                <a href="#" class="btn btn-sm btn-primary btn-shadow">Explore</a>
                                            </div>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                </div>
                                <!--end::Timeline details-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        <!--end::Timeline item-->
                        <!--begin::Timeline item-->
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line w-40px"></div>
                            <!--end::Timeline line-->
                            <!--begin::Timeline icon-->
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
												<path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />
											</svg>
										</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Timeline icon-->
                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="pe-3 mb-5">
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">New case
                                        <a href="#" class="text-primary fw-bolder me-1">#67890</a>is assigned to you in Multi-platform Database Design project</div>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="overflow-auto pb-5">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="text-muted me-2 fs-7">Added at 4:23 PM by</div>
                                            <!--end::Info-->
                                            <!--begin::User-->
                                            <a href="#" class="text-primary fw-bolder me-1">Alice Tan</a>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        <!--end::Timeline item-->
                        <!--begin::Timeline item-->
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line w-40px"></div>
                            <!--end::Timeline line-->
                            <!--begin::Timeline icon-->
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
												<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
											</svg>
										</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Timeline icon-->
                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="pe-3 mb-5">
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">You have received a new order:</div>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="text-muted me-2 fs-7">Placed at 5:05 AM by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Robert Rich">
                                            <img src="assets/media/avatars/150-14.jpg" alt="img" />
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                                <!--begin::Timeline details-->
                                <div class="overflow-auto pb-5">
                                    <!--begin::Notice-->
                                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/coding/cod004.svg-->
                                        <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M19.0687 17.9688H11.0687C10.4687 17.9688 10.0687 18.3687 10.0687 18.9688V19.9688C10.0687 20.5687 10.4687 20.9688 11.0687 20.9688H19.0687C19.6687 20.9688 20.0687 20.5687 20.0687 19.9688V18.9688C20.0687 18.3687 19.6687 17.9688 19.0687 17.9688Z" fill="black" />
													<path d="M4.06875 17.9688C3.86875 17.9688 3.66874 17.8688 3.46874 17.7688C2.96874 17.4688 2.86875 16.8688 3.16875 16.3688L6.76874 10.9688L3.16875 5.56876C2.86875 5.06876 2.96874 4.46873 3.46874 4.16873C3.96874 3.86873 4.56875 3.96878 4.86875 4.46878L8.86875 10.4688C9.06875 10.7688 9.06875 11.2688 8.86875 11.5688L4.86875 17.5688C4.66875 17.7688 4.36875 17.9688 4.06875 17.9688Z" fill="black" />
												</svg>
											</span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                            <!--begin::Content-->
                                            <div class="mb-3 mb-md-0 fw-bold">
                                                <h4 class="text-gray-900 fw-bolder">Database Backup Process Completed!</h4>
                                                <div class="fs-6 text-gray-700 pe-7">Login into Rider Admin Dashboard to make sure the data integrity is OK</div>
                                            </div>
                                            <!--end::Content-->
                                            <!--begin::Action-->
                                            <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap">Proceed</a>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Timeline details-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        <!--end::Timeline item-->
                        <!--begin::Timeline item-->
                        <div class="timeline-item">
                            <!--begin::Timeline line-->
                            <div class="timeline-line w-40px"></div>
                            <!--end::Timeline line-->
                            <!--begin::Timeline icon-->
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-gray-500">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
												<path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
												<path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
											</svg>
										</span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Timeline icon-->
                            <!--begin::Timeline content-->
                            <div class="timeline-content mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="pe-3 mb-5">
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">New order
                                        <a href="#" class="text-primary fw-bolder me-1">#67890</a>is placed for Workshow Planning &amp; Budget Estimation</div>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="text-muted me-2 fs-7">Placed at 4:23 PM by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <a href="#" class="text-primary fw-bolder me-1">Jimmy Bold</a>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        <!--end::Timeline item-->
                    </div>
                    <!--end::Timeline items-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer py-5 text-center" id="kt_activities_footer">
                <a href="../dist/account/activity.html" class="btn btn-bg-white text-primary">View All Activities
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                    <span class="svg-icon svg-icon-3 svg-icon-primary">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
							<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
						</svg>
					</span>
                    <!--end::Svg Icon--></a>
            </div>
            <!--end::Footer-->
            <div class="overlay">
                <div class="mt-15">
                    We are working on activity logs...
                </div>
            </div>
        </div>

    </div>
    <!--end::Activities drawer-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                    </svg>
                </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->

    <!--end::Main-->

    <script>var hostUrl = "assets/";</script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="/user/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/user/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="/user/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="/user/assets/js/custom/widgets.js?v=6"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
    {!! setting_item('footer_scripts') !!}
    @stack('js')
</body>
</html>
