@extends('layouts.home')
@push('headtags')
<meta name="keywords" content="EMA Parking, airport parking, Pegasus Business Park, Castle Donington parking, affordable airport parking, secure parking, Midlands Parking Ltd, parking services, long-term parking, short-term parking, airport parking Derby, UK airport parking, EMA Parking About Us">
@endpush
@push('tagscript')
<script defer type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Corporation",
        "name": "About Us",
        "alternateName": "About Us",
        "url": "https://emaparking.co.uk/about-us",
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
        "name": "About Us",
        "speakable": {
            "@type": "SpeakableSpecification",
            "xPath": [
                "/html/head/title",
                "/html/head/meta[@name='description']/@content"
            ]
        },
        "url": "https://emaparking.co.uk/about-us"
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
            "name": "About Us",
            "item": "https://emaparking.co.uk/about-us"
        }]
    }]
    </script>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "About Us",
        "url": "https://emaparking.co.uk/about-us",
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
        "name": "About Us",
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
        "url": "https://emaparking.co.uk/about-us",
        "logo": "https://emaparking.co.uk/uploads/0000/1/2023/04/08/02.png",
        "image": "https://emaparking.co.uk/home/img/about/about3.webp",
        "priceRange": "$$"
    }
</script> 
@endpush

@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>About Us</h2>
                        <div class="bt-option">
                            <a href="/">Home</a>
                            <span>About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- About Us Page Section Begin -->
    <section class="aboutus-page-section spad">
        <div class="container">
            <div class="about-page-text">
                <div class="row">
                    <div class="col-lg-9">
                            <div class="ap-title" style="text-align: left;">
                            <h1>Welcome To Midlands Parking</h1>
                            <p style="text-align: justify;">
                                Midlands offers the best deals for parking options at East Midlands Airport. We are working on adding more airports and parking services across the UK, and only those parking facilities are featured on our website that meet our set standards of security criteria. Not only that, but we are also working on creating full-fledge travel options for you soon to give you the luxurious experience at and affordable rates. So, stay tuned for more options, such as hotels and lounges.
                                <br> <br>
                                Midlands is committed to finding you the best product for your requirements. We are a customer-centered and market-driven company, focused solely to make traveling easy and hassle-free! Our state-of-the-art protected transaction policy and a simple UI have been created to give a seamless experience to our clients. Midlands Parking takes all trends in the tourism business into account, invests in new infrastructure, and offers both leisure and business travel solutions through its advanced technology. Our customer support teams are trained to uphold a high degree of professionalism with courtesy and skill.
                                <br> <br>
                                Midlands Parking is the preferred airport parking booking website for most travel management companies and their thousands of clients. To find out more about how you could become one of our parking partners and enjoy a variety of business discounts you can contact us at our phone number or email us at our official email address.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 my-auto">
                        <ul class="ap-services">
                            <li><i class="icon_check"></i> Value for money</li>
                            <li><i class="icon_check"></i> Secure car parking</li>
                            <li><i class="icon_check"></i> Park Mark Awarded</li>
                            <li><i class="icon_check"></i> Fenced car parking</li>
                            <li><i class="icon_check"></i> Disability friendly spaces</li>
                            <li><i class="icon_check"></i> 95% rebooking rate</li>
                            <li><i class="icon_check"></i> Ideal choice</li>
                            <li><i class="icon_check"></i> Hassle-free booking</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="about-page-services">
                <div class="row">
                    <div class="col-md-4">
                        <div class="ap-service-item set-bg"
                             data-setbg="/home/img/products/flexible.jpeg"
                             style="background-color: rgb(0 0 0 / 50%); background-blend-mode: overlay">
                            <div class="api-text">
                                <h3>Midlands Meet & Greet Flexible</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ap-service-item set-bg"
                             data-setbg="/home/img/products/non-flexible.jpeg"
                             style="background-color: rgb(0 0 0 / 50%); background-blend-mode: overlay">
                            <div class="api-text">
                                <h3>Midlands Meet & Greet Non-Flexible</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ap-service-item set-bg"
                             data-setbg="/home/img/products/undercover.jpeg"
                             style="background-color: rgb(0 0 0 / 50%); background-blend-mode: overlay">
                            <div class="api-text">
                                <h3>Midlands Meet & Greet Undercover</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Page Section End -->

    <!-- Video Section Begin -->
    <section class="video-section set-bg" style="background-color: rgb(0 0 0 / 50%); background-blend-mode: overlay" data-setbg="/home/img/airport-terminal-min.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="video-text">
                        <h2>Midland's Parking Summer Sale.</h2>
                        <p>Midland's Parking offers exclusive meet and greet parking options at the cheapest rates in the industry. Parking slots are limited, so avail this opportunity NOW. </p>
                        <a style="filter: hue-rotate(180deg)" class="play-btn video-popup" href="https://www.youtube.com/watch?v=sIbM8N10m7M"><img
                                alt="image" src="/home/img/play.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video Section End -->

    <!-- Gallery Section Begin -->
    <section class="gallery-section spad">
        <div class="about-page-services container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <!--<span>Our Gallery</span>-->
                        <h2>What is Meet & Greet?</h2>
                        <span>Meet and greet parking is simply a hassle-free solution and great start to your holiday or business trip.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ap-service-item set-bg">
                                <div class="api-text text-dark px-4" style="text-align: justify;">
                                    <p>Using offsite or long stay parking, finding a parking space, unsure about the safety
                                        of your car and on top of which you have to carry your luggage for 5 to 10 minutes
                                        to reach the terminal. As per your booking we meet you at the airport with a
                                        personal chauffeur who will drive your vehicle away to our car park nearby and greet
                                        you on your return with your vehicle ready to go.</p>
                                    <br> <br>
                                    <p>Great for business trips or pleasure, an easy way to avoid delays and stress at the
                                        airport. Take the hassle out of your journey dragging your luggage in the massive
                                        car parks. Our representative will meet you at the rapid drop off area right outside
                                        departures. Our staff will make a brief video of your vehicle and you are ready to
                                        start your holiday /trip in no time.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="ap-service-item set-bg"
                                 data-setbg="/home/img/slider/slider5.jpg">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Gallery Section End -->

    <!-- Process Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Why Book Midlands Meet & Greet?</h2>
                        <span>Meet and greet service at affordable price!</span>
                    </div>
                </div>
            </div>

            <div class="row mt-5" style="text-align: justify;">
                <div class="col-md-12">
                    <div class="featured-item d-flex">
                        <div class="col-2 col-lg-1">
                            <div class="mr-2 mb-2 bg-primary rounded p-2">
                                <img style="filter: invert(1);"  src="/home/img/about/compare.png" alt="compare img" class="img-fluid">
                            </div>
                        </div>
                        <div class="flex-fill">
                            <div class="desc font-size-20">Compare our Meet and Greet parking to the cost of Airport transfers or the risks of parking at the Airport itself, we're confident we provide the best value for money. We provide exceptional service, and you will be met at the terminal itself – 24/7 service, all year round.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="featured-item d-flex">
                        <div class="col-2 col-lg-1">
                            <div class="mr-2 mb-2 bg-primary rounded p-2">
                                <img style="filter: invert(1);" src="/home/img/about/staff.png" alt="staff img" class="img-fluid">
                            </div>
                        </div>
                        <div class="content">
                            <h4 class="sub-title">

                            </h4>
                            <div class="desc font-size-20">Our staff are well-trained to provide professional service and Midlands Parking has comprehensive insurance cover in place for your peace of mind. We have made meet and greet parking simpler to take stress away and make parking more convenient than hassle! Whether you're flying for business or pleasure, we provide friendly treatment to our valued customers and ensure our dedicated team is always there to help you.</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="featured-item d-flex">
                        <div class="col-1 col-lg-1">
                            <div class="mr-2 mb-2 bg-primary rounded p-2">
                                <img style="filter: invert(1);"  src="/home/img/about/car.png" alt="car img" class="img-fluid">
                            </div>
                        </div>
                        <div class="flex-fill">
                            <h4 class="sub-title">

                            </h4>
                            <div class="desc font-size-20">We provide extensive care to your vehicle and keep your vehicle in our dedicated compound. Let us take care of your parking needs whilst you concentrate on your holiday or business trip. No hidden charges! Book now with our secure online booking payment system.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
