@extends('layouts.home')
@push('headtags')
<meta name="keywords" content="EMA Parking, Airport Parking, Parking Services, Midlands Parking, East Midlands Airport Parking, Pegasus Business Park, Castle Donington Parking, Secure Airport Parking, UK Parking Solutions, Derby Parking, Affordable Parking near Airport, ema airport parking, em airport parking, parking airport east midlands">
@endpush
@push('tagscript')
<script defer type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Corporation",
        "name": "EMA Parking",
        "alternateName": "EMA Parking",
        "url": "https://emaparking.co.uk/",
        "logo": "https://emaparking.co.uk/uploads/0000/1/2023/04/08/02.png",
        "sameAs": [
            "https://emaparking.co.uk/",
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
        "name": "EMA Parking",
        "speakable": {
            "@type": "SpeakableSpecification",
            "xPath": [
                "/html/head/title",
                "/html/head/meta[@name='description']/@content"
            ]
        },
        "url": "https://emaparking.co.uk/"
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
        }]
    }]
    </script>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "EMA Parking",
        "url": "https://emaparking.co.uk/",
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
        "name": "EMA Parking",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Pegasus Business Park, Herald Way",
            "addressLocality": "Castle Donington",
            "addressRegion": "Derby",
            "postalCode": "DE74 2TZ",
            "addressCountry": "UK"
        },
        "openingHours": "Mon,Tue,Wed,Thu,Fri, Sat, Sun 00:00-23:59",
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "52.825620",
            "longitude": "-1.311560"
        },
        "url": "https://emaparking.co.uk/",
        "logo": "https://emaparking.co.uk/uploads/0000/1/2023/04/08/02.png",
        "image": "https://emaparking.co.uk/home/img/about/about3.webp",
        "priceRange": "$$"
    }
    </script>
    
@endpush
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 mx-auto col-12 order-1 order-xl-0">
                    <div class="hero-text pt-xl-0">
                        <h1>Midlands Meet and Greet Parking</h1>
                        <p>Book safely with BPA accredited parking at cheapest rates.</p>
                        <!--<a href="#" class="primary-btn">Discover Now</a>-->
                    </div>
                </div>
                <div class="col-xl-6 mx-auto col-lg-8 offset-xl-2 offset-lg-1 order-0 order-xl-1">

                    <ul class="nav nav-tabs nav-fill mb-3 bg-white rounded" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link active"
                                id="ex2-tab-1"
                                data-bs-toggle="tab"
                                href="#ex2-tabs-1"
                                role="tab"
                                aria-controls="ex2-tabs-1"
                                aria-selected="true"
                            >Airport Parking</a
                            >
                        </li>
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link"
                                id="ex2-tab-2"
                                data-bs-toggle="tab"
                                href="#ex2-tabs-2"
                                role="tab"
                                aria-controls="ex2-tabs-2"
                                aria-selected="false"
                            >Hotels</a
                            >
                        </li>
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link"
                                id="ex2-tab-3"
                                data-bs-toggle="tab"
                                href="#ex2-tabs-3"
                                role="tab"
                                aria-controls="ex2-tabs-3"
                                aria-selected="false"
                            >Lounges</a
                            >
                        </li>
                    </ul>
                    <div class="tab-content" id="ex2-content">
                        <div
                            class="tab-pane fade show active"
                            id="ex2-tabs-1"
                            role="tabpanel"
                            aria-labelledby="ex2-tab-1"
                        >
                            <div class="booking-form px-3">
                            <h3 class="text-center">Book Your Parking</h3>
                            <form action="{{ route("space.search") }}">


                                <div class="select-option">
                                    <label for="airport">Airport:</label>
                                    <select name="location_id" id="airport">
                                        <option selected value="11">East Midlands</option>
                                        <option disabled value="">Coming soon</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7 col-md-6 col-6">
                                        <div class="check-date">
                                            <label for="date-in">Arrival:</label>
                                            <div class="u-datepicker overflow-hidden input-group flex-nowrap form-date-search is_single_picker">
                                                <div style="top:13px; left: 20px;" class="date-wrapper position-absolute shadow-none border-0 form-control hero-form bg-transparent flatpickr-input p-0">
                                                    <div class="render check-in-render" style="font-size:16px; font-weight: 500; color: black">{{Request::query('start',display_date(strtotime("+1 day")))}}</div>
                                                </div>
                                                <input type="hidden" class="check-in-input" value="{{Request::query('start',date("m/d/Y",strtotime("+1 day")))}}" name="start">
                                                <input type="text" id="date-in" class="check-in-out" style="color: white;" name="date1" value="{{Request::query('date1',date("Y-m-d",strtotime("+1 day")))}}">
                                                <span class="d-flex align-items-center mr-2 font-size-21">
                                                    <i class="icon_calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-6">
                                        <div class="check-date">
                                            <label for="date-in">Time:</label>

                                            <div class="u-datepicker overflow-hidden input-group flex-nowrap border">

                                                <input style="border: none;" type="time" name="arrival_time" value="{{Request::query('arrival_time','12:00')}}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7 col-md-6 col-6">
                                        <div class="check-date">
                                            <label for="date-out">Return:</label>
                                            <div class="u-datepicker overflow-hidden input-group flex-nowrap form-date-search is_single_picker">
                                                <div style="top:13px; left: 20px;" class="date-wrapper position-absolute shadow-none border-0 form-control hero-form bg-transparent flatpickr-input p-0">
                                                    <div class="render check-in-render" style="font-size:16px; font-weight: 500; color: black">{{Request::query('end',display_date(strtotime("+7 day")))}}</div>
                                                </div>
                                                <input type="hidden" class="check-in-input" value="{{Request::query('end',date("m/d/Y",strtotime("+7 day")))}}" name="end">
                                                <input type="text" id="date-out" class="check-in-out" style="color: white;" name="date2" value="{{Request::query('date2',date("Y-m-d",strtotime("+7 day")))}}">
                                                <span class="d-flex align-items-center mr-2 font-size-21">
                                                    <i class="icon_calendar"></i>
                                                </span>
                                            </div>
                                        </div>
<!--                                        <div class="check-date">
                                            <label for="date-out">Check Out:</label>

                                            <div class="u-datepicker overflow-hidden input-group flex-nowrap form-date-search is_single_picker">
                                                <div class="input-group-prepend">
                                                    <span class="d-flex align-items-center mr-2 font-size-21">
                                                         <i class="icon_calendar"></i>
                                                    </span>
                                                </div>

                                                <input type="hidden" class="check-out-input" value="{{Request::query('start',display_date(strtotime("+7 day")))}}" name="end">
                                                <input type="text" class="check-in-out" name="date2" value="{{Request::query('date2',date("m/d/Y",strtotime("+7 day")))}}">
                                            </div>

                                        </div>-->
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-6">
                                        <div class="check-date">
                                            <label for="date-in">Time:</label>

                                            <div class="u-datepicker overflow-hidden input-group flex-nowrap border">

                                                <input style="border: none;" type="time" name="departure_time" value="{{Request::query('arrival_time','12:00')}}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <div class="check-date mb-0">
                                            <label for="date-in">Coupon:</label>

                                            <div class="u-datepicker overflow-hidden input-group flex-nowrap border">

                                                <input style="border: none;" type="text" name="coupon" value="{{Request::query('coupon')}}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <button class="btn btn-primary text-white" type="submit">Book Now</button>
                                    </div>

                                </div>


                            </form>


                        </div>
                        </div>
                        <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">
                            <div class="booking-form">
                                <img src="/images/comming_soon.webp" alt="comming_soon">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">
                            <div class="booking-form">
                                <img src="/images/comming_soon.webp" alt="comming_soon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
      
        </style>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg  hero-sliderimagecss"  data-setbg="/home/img/slider/slider1.jpeg" ></div>
            <div class="hs-item set-bg  hero-sliderimagecss"  data-setbg="/home/img/slider/slider2.jpeg"></div>
            <div class="hs-item set-bg  hero-sliderimagecss"  data-setbg="/home/img/slider/slider3.jpeg"></div>
            <div class="hs-item set-bg  hero-sliderimagecss"  data-setbg="/home/img/slider/slider4.jpg"></div>
            <div class="hs-item set-bg  hero-sliderimagecss"  data-setbg="/home/img/slider/slider5.jpg"></div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text" style="text-align: justify">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>Midlands Parking<br/>Meet & Greet</h2>
                        </div>
                        <p class="f-para">Midlands Airport Parking Ltd offers the discounted <a href="https://emaparking.co.uk/space">Meet and Greet parking at East Midlands Airport</a>. We are working on adding more airports and parking services across the UK, and only those parking facilities are featured on our website that meet our set standards of security criteria. Not only that, but we are also working on creating full-fledged travel options for you soon to give you the luxurious experience at affordable rates. So, stay tuned for more options, such as hotels and lounges.</p>
                        <p class="s-para">Midlands is committed to finding you the best meet and greet product for your requirements. We are a customer-centred and market-driven company, focused solely to make travelling easy and hassle-free! Our state-of-the-art protected transaction policy and a simple UI have been created to give a seamless experience to our clients. Midlands Parking takes all trends in the tourism business into account, invests in new infrastructure, and offers both leisure and business travel solutions through its advanced technology.</p>
                        <a class="primary-btn about-btn" href="{{route('about')}}">Learn More About Midlands Parking</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic mt-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <img alt="about1" src="/home/img/about/about1.webp">
                            </div>
                            <div class="col-sm-12">
                                <img alt="about2" src="/home/img/about/about2.webp">
                            </div>
                            <div class="col-sm-12">
                                <img alt="about2" src="/home/img/about/about3.webp">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Client 1 - HCF Bootstrap 5 Component -->
    <section class="py-5 py-xl-6">
        <div class="container mb-5 mb-md-6">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6 text-center">
                    <h2 class="mb-4 display-5">Partner Agents</h2>
                    <p class="text-secondary mb-4 mb-md-5">These trusted EMA parking partners have joined hands with us to provide you with exceptional services and support. Together, we strive to offer you the best solutions and experiences. Explore our network of partner agents and discover the collaborative spirit that drives us to deliver excellence.</p>
                    <hr class="w-50 mx-auto mb-0 text-secondary">
                </div>
            </div>
        </div>
        <div class="container overflow-hidden">
            <div class="row gy-5 gy-md-6 rounded py-5" style="background-color: #a3caff!important">
                <div class="col-6 col-md-3 align-self-center text-center">
                    <img src="/home/img/partners/bookFHR.svg" alt="img" height="50">
                </div>
                <div class="col-6 col-md-3 align-self-center text-center">
                    <img src="/home/img/partners/compareParking.webp" alt="img" height="60">
                </div>
                <div class="col-6 mt-4 mt-md-0 col-md-3 align-self-center text-center">
                    <img src="/home/img/partners/looking4.webp" alt="img" height="100">
                </div>
                <div class="col-6 mt-4 mt-md-0 col-md-3 align-self-center text-center">
                    <img src="/home/img/partners/parkAndGo.webp" alt="img" height="80">
                </div>
                <div class="col-6 mt-4 col-md-3 align-self-center text-center">
                    <img src="/home/img/partners/parking4You.png" alt="img" height="80">
                </div>
                <div class="col-6 mt-4 col-md-3 align-self-center text-center">
                    <img src="/home/img/partners/skyParkingServices.png?v=1" alt="img" height="50">
                </div>
                <div class="col-6 mt-4 col-md-3 align-self-center text-center">
                    <img src="/home/img/partners/travelAirportPlus.webp" alt="img" height="100">
                </div>
                <div class="col-6 mt-4 col-md-3 align-self-center text-center">
                    <img src="/home/img/partners/skyparksecure.png" alt="img" height="50">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-036-parking"></i>
                        <h4>Airport Parking</h4>
                        <p>Convenient East Midlands Airport Parking Discount at EMA parking, ensuring hassle-free airport parking experience.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-026-bed"></i>
                        <h4>Hotels</h4>
                        <p>Comfortable and convenient hotel accommodation near your travel destinations, providing a relaxing stay for your travel needs.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-031-elevator"></i>
                        <h4>Lounges</h4>
                        <p>Relax and unwind in luxurious airport lounges at east midlands airport meet and greet parking, offering a tranquil and indulgent pre-flight experience.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-009-cctv"></i>
                        <h4>CCTV</h4>
                        <p>EMA parking facilities have a state-of-the-art CCTV surveillance system at airport parking in the east midlands that ensures high-level security.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-022-clock"></i>
                        <h4>Customer Support</h4>
                        <p>Dedicated to customer support round the clock, offering friendly assistance and prompt resolution for all your inquiries and needs.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-010-newspaper"></i>
                        <h4>Discounts & Coupons</h4>
                        <p>EMA parking regularly keeps the promotional discounts live, and if you would like to stay tuned for such updates, please subscribe to our newsletter.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Products</span>
                        <h2>Discover Our Parking Spaces</h2>
                    </div>
                </div>
            </div>
            <div class="hp-room-items">
                <div class="row">
                    <div class="col-lg-4 mx-auto col-md-6">
                        <div class="hp-room-item set-bg" style="background-color: #000000cf; background-blend-mode: overlay" data-setbg="/home/img/products/flexible.jpeg">
                            <div class="d-flex justify-content-center mt-4">
                                <div class="d-flex flex-column" style="max-width: 150px">
                                    <img style="opacity: 0.2" src="/home/img/parkMark.webp" class="img-responsive" alt="image">
                                    <img style="opacity: 0.2; height: 58px;" src="/home/img/bpa.jpeg" class="img-responsive" alt="image">
                                </div>

                            </div>
                            <div class="hr-text">
                                <h3>Midlands Meet & Greet Flexible</h3>

                                <div class="d-flex flex-wrap align-items-center justify-content-center pt-2">

                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="CCTV">
                                        <i class="text-white icofont-video-cam" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Fencing">
                                        <i class="text-white icofont-ui-lock" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Secure Barrier">
                                        <i class="text-white icofont-shield-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Patrolled">
                                        <i class="text-white icofont-user-alt-1" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Disability Friendly">
                                        <i class="text-white icofont-paralysis-disability" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Security Lighting">
                                        <i class="text-white icofont-bulb-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Family Friendly">
                                        <i class="text-white icofont-users-alt-5" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Business Friendly">
                                        <i class="text-white icofont-bag-alt" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <ul style="color: white">
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> Midlands meet and greet</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1 " aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> Value for money, secure car park with Park Mark award with secure perimeter fencing and disability friendly space.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> Leave your keys; and meet and greet and the Short Stay 1 at the airport.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> Airport charges £6 apply each way.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span>  Ideal choice, 95% of customers said they would book again.</span>
                                        </div>
                                    </li>
                                </ul>
                                <a href="#" class="primary-btn spaceDetails text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="14">>More Details</a>
                                <div class="d-flex justify-content-center mt-4">
                                    <a href="https://emaparking.co.uk/space/midlands-meet-greet-flexible" class="btn btn-primary" tabindex="0">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mx-auto col-md-6">
                        <div class="hp-room-item set-bg" style="background-color: #000000cf; background-blend-mode: overlay" data-setbg="/home/img/products/non-flexible.jpeg?v=1">
                            <div class="d-flex justify-content-center mt-4">
                                <div class="d-flex flex-column" style="max-width: 150px">
                                    <img style="opacity: 0.2" src="/home/img/parkMark.jpeg"  class="img-responsive" alt="home banner">
                                    <img style="opacity: 0.2; height: 58px;" src="/home/img/bpa.jpeg" class="img-responsive" alt="home banner">
                                </div>

                            </div>
                            <div class="hr-text">
                                <h3>Midlands Meet & Greet Non-Flexible</h3>

                                <div class="d-flex flex-wrap align-items-center justify-content-center pt-2">

                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="CCTV">
                                        <i class="text-white icofont-video-cam" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Fencing">
                                        <i class="text-white icofont-ui-lock" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Secure Barrier">
                                        <i class="text-white icofont-shield-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Patrolled">
                                        <i class="text-white icofont-user-alt-1" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Disability Friendly">
                                        <i class="text-white icofont-paralysis-disability" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Security Lighting">
                                        <i class="text-white icofont-bulb-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Family Friendly">
                                        <i class="text-white icofont-users-alt-5" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Business Friendly">
                                        <i class="text-white icofont-bag-alt" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <ul style="color: white">
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span>  This is a non-flex product and cannot be cancelled/amended.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1 " aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> Value for money, secure car park with Park Mark award with secure perimeter fencing and disability friendly space.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> Meet and greet at the Short Stay 1 at the airport.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> Airport charges £6 apply each way.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> 90% of customers recommend this choice.</span>
                                        </div>
                                    </li>
                                </ul>
                                <a href="#" class="primary-btn spaceDetails text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="15">>More Details</a>
                                <div class="d-flex justify-content-center mt-4">
                                    <a href="https://emaparking.co.uk/space/midlands-meet-greet-non-flexible" class="btn btn-primary" tabindex="0">Book Now</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mx-auto col-md-6">
                        <div class="hp-room-item set-bg" style="background-color: #000000cf; background-blend-mode: overlay" data-setbg="/home/img/products/undercover.jpeg">
                            <div class="d-flex justify-content-center mt-4">
                                <div class="d-flex flex-column" style="max-width: 150px">
                                    <img style="opacity: 0.2" src="/home/img/parkMark.jpeg" class="img-responsive" alt="home banner">
                                    <img style="opacity: 0.2; height: 58px;" src="/home/img/bpa.jpeg" class="img-responsive" alt="home banner">
                                </div>

                            </div>

                            <div class="hr-text bottom-0">
                                <h3>Midlands Meet & Greet All Inclusive</h3>

                                <div class="d-flex flex-wrap align-items-center justify-content-center pt-2">

                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="CCTV">
                                        <i class="text-white icofont-video-cam" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Fencing">
                                        <i class="text-white icofont-ui-lock" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Secure Barrier">
                                        <i class="text-white icofont-shield-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Patrolled">
                                        <i class="text-white icofont-user-alt-1" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Disability Friendly">
                                        <i class="text-white icofont-paralysis-disability" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Security Lighting">
                                        <i class="text-white icofont-bulb-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Family Friendly">
                                        <i class="text-white icofont-users-alt-5" aria-hidden="true"></i>
                                    </div>
                                    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Business Friendly">
                                        <i class="text-white icofont-bag-alt" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <ul style="color: white">
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span>Midlands meet and greet all inclusive no additional price</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1 " aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> Value for money, secure car park with Park Mark award with secure perimeter fencing and disability friendly space.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span> Meet and greet at the Short Stay 1 at the airport.</span>
                                        </div>
                                    </li>

                                    <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                                        <div class="ml-2 d-block"><span>  VIP experience: ideal for families and business travelers.</span>
                                        </div>
                                    </li>
                                </ul>
                                <a href="#" class="primary-btn spaceDetails text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="16">More Details</a>
                                <div class="d-flex justify-content-center mt-4">
                                    <a href="https://emaparking.co.uk/space/midlands-meet-greet-all-inclusive" class="btn btn-primary" tabindex="0">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade productModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <livewire:product-details/>
            </div>
        </div>
    </section>
    <!-- Process Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>The Simple Booking Process</span>
                        <h2>Secure Booking in 4 Steps</h2>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="featured-item d-flex">
                        <div class="col-4 col-lg-2">
                            <div class="mr-2 mb-2 bg-primary rounded p-2">
                                <img style="filter: invert(1);"  src="https://emaparking.co.uk/uploads/0000/1/2023/05/19/events-outlined-calendar.png" class="img-fluid" alt="image">
                            </div>
                        </div>
                        <div class="flex-fill">
                            <h4 class="sub-title">
                                Select the booking dates
                            </h4>
                            <div class="desc">Select the booking date range from the calendar. Ensure your flight departure and arrival dates conform to the booking dates.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <div class="featured-item d-flex">
                        <div class="col-4 col-lg-2">
                            <div class="mr-2 mb-2 bg-primary rounded p-2">
                                <img style="filter: invert(1);" src="https://emaparking.co.uk/uploads/0000/1/2023/05/19/select.png" class="img-fluid" alt="image">
                            </div>
                        </div>
                        <div class="content">
                            <h4 class="sub-title">
                                Select the parking option
                            </h4>
                            <div class="desc">Choose the right east midlands airport meet and greet parking space type, <a href="https://www.emaparking.co.uk/space/midlands-meet-greet-flexible">flexible</a>, <a href="https://www.emaparking.co.uk/space/midlands-meet-greet-non-flexible">non-flexible</a>, or <a href="https://www.emaparking.co.uk/space/midlands-meet-greet-all-inclusive">all-inclusive</a>, based on your date range selection.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="featured-item d-flex">
                        <div class="col-4 col-lg-2">
                            <div class="mr-2 mb-2 bg-primary rounded p-2">
                                <img style="filter: invert(1);"  src="https://emaparking.co.uk/uploads/0000/1/2023/05/19/confirmation.png" class="img-fluid" alt="image">
                            </div>
                        </div>
                        <div class="flex-fill">
                            <h4 class="sub-title">
                                Confirm your booking
                            </h4>
                            <div class="desc">You will be prompted to the <a href="https://emaparking.co.uk/space">booking form</a> , wherein you will include all the information related to your booking.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <div class="featured-item d-flex">
                        <div class="col-4 col-lg-2">
                            <div class="mr-2 mb-2 bg-primary rounded p-2">
                                <img style="filter: invert(1);"  src="https://emaparking.co.uk/uploads/0000/1/2023/05/19/check-out.png" class="img-fluid" alt="image">
                            </div>
                        </div>
                        <div class="flex-fill">
                            <h4 class="sub-title">
                                Complete the payment
                            </h4>
                            <div class="desc">Once you provide all the necessary personal details, you will be directed to the EMA parking 3D secure checkout page, so that you can securely pay the charges. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonials</span>
                        <h2>What Customers Say?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        <div class="ts-item">
                            <p>I recently used Midlands Meet and Greet flexible parking, and I was extremely satisfied with the service. The process was smooth, and the staff was friendly and professional. My car was well taken care of, and the convenience of being able to drop off and pick up my car right at the terminal was fantastic. Highly recommended!.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                </div>
                                <h5> - Jane</h5>
                            </div>

                        </div>
                        <div class="ts-item">
                            <p>
                                I've used Midlands Meet and Greet flexible parking multiple times, and it's always been a great experience. The team is punctual and efficient, and they make the entire parking process effortless. It's such a relief to have my car waiting for me right outside the terminal when I return from my trip. Definitely my go-to parking option at the airport.
                            </p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                </div>
                                <h5> - John Parker</h5>
                            </div>

                        </div>
                        <div class="ts-item">
                            <p>
                                can't say enough positive things about Midlands Meet and Greet flexible parking. The convenience it offers is unmatched. No more shuttle buses or long walks to the parking lot. The staff is friendly, and the service is reliable. It's a stress-free way to start and end my travels. I highly recommend it to anyone flying from Midlands Airport.
                            </p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                </div>
                                <h5> - Travel Enthusiast</h5>
                            </div>

                        </div>
                        <div class="ts-item">
                            <p>

                                I had an excellent experience with Midlands Meet and Greet flexible parking. The booking process was straightforward, and the instructions provided were clear. The team was professional and made sure everything went smoothly. It's a hassle-free parking option that I will continue to use whenever I fly from Midlands Airport.

                            </p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Sarah</h5>
                            </div>

                        </div>

                        <div class="ts-item">
                            <p>
                                Midlands Meet and Greet flexible parking exceeded my expectations. The convenience, speed, and reliability of their service are unmatched. The staff was courteous, and the process was effortless. I felt reassured knowing that my car was in safe hands while I was away. I highly recommend their services to fellow travellers.
                            </p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                </div>
                                <h5> - David Smith</h5>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Blog Section Begin -->
    <!--<section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Hotel News</span>
                        <h2>Our Blog & Event</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/blog-1.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Travel Trip</span>
                            <h4><a href="#">Tremblant In Canada</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 15th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/blog-2.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Camping</span>
                            <h4><a href="#">Choosing A Static Caravan</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 15th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/blog-3.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Event</span>
                            <h4><a href="#">Copper Canyon</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 21th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog-item small-size set-bg" data-setbg="img/blog/blog-wide.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Event</span>
                            <h4><a href="#">Trip To Iqaluit In Nunavut A Canadian Arctic City</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 08th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item small-size set-bg" data-setbg="img/blog/blog-10.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Travel</span>
                            <h4><a href="#">Traveling To Barcelona</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 12th April, 2019</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- Blog Section End -->
    <div class="bravo-call-to-action banner-block banner-v1 bg-img-hero py-5" style="background-color: #4757c6;background-blend-mode: overlay;background-image: url(https://emaparking.co.uk/uploads/0000/1/2023/05/24/v915-wit-001-l.jpg) !important;">
        <div class="container">
            <div class="mx-auto text-center mt-xl-5 mb-xl-2 px-3 px-md-0">
                <h6 class="text-white font-size-40 font-weight-bold mb-1 display-4">Use code SUMMER30 at checkout</h6>
                <p class="text-white font-size-18 font-weight-normal mb-4 pb-1 px-md-3 px-lg-0">
                Get 30% Whopping Discount on All EMA Meet and Greet Parking Options
                </p>
                <a class="btn btn-light btn-lg border-width-2 rounded-xs min-width-200 font-weight-normal transition-3d-hover" href="https://emaparking.co.uk/space">
                    Book now
                </a>
            </div>
        </div>
    </div>
    <style>
        input[type=time]::-ms-clear,
        input[type=time]::-webkit-clear-button {
            background: #5191FA;
        }
        input[type="time"]::-webkit-calendar-picker-indicator{
            filter: invert(90%) sepia(13%) saturate(3207%) hue-rotate(130deg) brightness(150%) contrast(40%);
            padding-right: 17px;
            background-size: cover;
            height: 20px;
        }

        @media screen and (max-width: 991px) {
            .hp-room-items .hp-room-item .hr-text {
                position: unset;
                padding: 50px;
            }
            .hp-room-items .hp-room-item {
                height: auto;
            }
            .hero-section {
                padding-top: 20px;
            }
        }
    </style>
@endsection

@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        $('.spaceDetails').click(function () {
            id = $(this).data('id');
            Livewire.emit('getProduct',id)
        });
    </script>
@endpush
