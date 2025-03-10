@extends('layouts.app')
@push('css')
    <link href="{{ asset('themes/mytravel/dist/frontend/module/news/css/news.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
@endpush
@push('headtags')
<meta name="keywords" content="EMA Parking, airport parking, parking tips, travel tips, Midlands parking, secure parking, car parking, parking services, parking updates, travel advice, airport travel, parking information, car safety, parking FAQs, parking blog" />
@endpush
@push('tagscript')
<script defer type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Corporation",
        "name": "EMA Parking - Blogs Updates",
        "alternateName": "EMA Parking - Blogs Updates",
        "url": "https://emaparking.co.uk/blog",
        "logo": "https://emaparking.co.uk/uploads/0000/1/2023/04/08/02.png",
        "sameAs": [
            "https://emaparking.co.uk/blog",
            "https://www.facebook.com/people/Midlands-Parking-Ltd/100092626675848/",
            "https://www.youtube.com/@MidlandsParkingLtd",
            "https://www.instagram.com/midlandsparkingltd/"
        ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "WebPage",
        "name": "EMA Parking - Blogs Updates",
        "speakable": {
            "@type": "SpeakableSpecification",
            "xPath": [
                "/html/head/title",
                "/html/head/meta[@name='description']/@content"
            ]
        },
        "url": "https://emaparking.co.uk/blog"
    }
    </script>
    <script type="application/ld+json">
    [{
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "https://emaparking.co.uk/"
        },{
            "@type": "ListItem",
            "position": 2,
            "name": "Blog",
            "item": "https://emaparking.co.uk/blog"
        }]
    }]
    </script>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "EMA Parking - Blogs Updates",
        "url": "https://emaparking.co.uk/blog",
        "logo": "https://emaparking.co.uk/uploads/0000/1/2023/04/08/02.png",
        "contactPoint": [{
            "@type": "ContactPoint",
            "email": "support@emaparking.co.uk",
            "contactType": "customer service"
        }]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "LocalBusiness",
        "name": "EMA Parking - Blogs Updates",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Pegasus Business Park, Herald Way",
            "addressLocality": "Castle Donington",
            "addressRegion": "Derby",
            "postalCode": "DE74 2TZ",
            "addressCountry": "UK"
        },
        "telephone": "+44",
        "openingHours": "Mon,Tue,Wed,Thu,Fri, Sat, Sun 00:00-23:59",
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "52.825620",
            "longitude": "-1.311560"
        },
        "url": "https://emaparking.co.uk/blog",
        "logo": "https://emaparking.co.uk/uploads/0000/1/2023/04/08/02.png",
        "image": "https://emaparking.co.uk/home/img/about/about3.webp",
        "priceRange": "$$"
    }
    </script>
    
@endpush
@section('content')
    <div class="bravo-news">
        @php
            $title_page = setting_item_with_lang("news_page_list_title");
            if(!empty($custom_title_page)){
                $title_page = $custom_title_page;
            }
        @endphp
        <div class="bg-img-hero text-center mb-5 mb-lg-8" @if($bg = setting_item("news_page_list_banner")) style="background-image: url({{get_file_url($bg,'full')}})" @endif >
            <div class="container space-top-xl-3 py-6 py-xl-0">
                <div class="row justify-content-center py-xl-4">
                    <div class="py-xl-10 py-5">
                        <h1 class="font-size-40 font-size-xs-30 text-white font-weight-bold mb-0">{{ $title_page }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter mb-0">
                                <li class="breadcrumb-item font-size-14"><a class="text-white" href="{{ url("/") }}">{{ __("Home") }}</a></li>
                                <li class="breadcrumb-item custom-breadcrumb-item font-size-14 text-white active" aria-current="page">{{ $title_page }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-6 mb-lg-8 pt-lg-1">
            <div class="container mb-5 mb-lg-9 pb-lg-1">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        <div class="mb-5 pb-1">
                            @if($rows->count() > 0)
                                @foreach($rows as $row)
                                    @include('News::frontend.layouts.details.news-loop')
                                @endforeach
                            @else
                                <div class="alert alert-danger">
                                    {{__("Sorry, but nothing matched your search terms. Please try again with some different keywords.")}}
                                </div>
                            @endif
                        </div>
                        @if($rows->total() > 0)
                            <div class="text-center text-md-left font-size-14 mb-3 text-lh-1">{{ __("Showing :from - :to of :total",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</div>
                        @endif
                        {{$rows->appends(request()->query())->links()}}
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        @include('News::frontend.layouts.details.news-sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


