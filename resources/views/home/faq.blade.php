@extends('layouts.home')
@push('headtags')
<meta name="keywords" content="EMA Parking, parking FAQs, airport parking questions, Midlands Parking, car parking, meet and greet parking, airport car services, customer service, car drop-off, car collection, parking insurance, East Midlands Airport">@endpush
@push('tagscript')
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How will I know that my booking is confirmed?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "After you have completed your booking, you will receive a confirmation e-mail from Midlands Parking LTD."
          }
        },
        {
          "@type": "Question",
          "name": "Where will my car be parked?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Your car is parked in MIDLANDS car park which is 10 minutes from the airport. Our sites have awarded Park Mark and accessed by the police for safety."
          }
        },
        {
          "@type": "Question",
          "name": "Who will I hand over my vehicle to?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "You will be greeted by a Midlands chauffeur at the airport, and they will take your vehicle away to be parked in our parking area."
          }
        },
        {
          "@type": "Question",
          "name": "How will I recognise MidlandsFly Parking chauffeur?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Our chauffeur will be wearing Midlands Parking black shirt and black trousers with company ID cards."
          }
        },
        {
          "@type": "Question",
          "name": "Are MidlandsFly Parking drivers insured?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Midlands chauffeurs are fully insured and all Midlands staff are covered with third party liability insurance."
          }
        },
        {
          "@type": "Question",
          "name": "Where will I handover my car?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Our staff will meet you at the rapid drop off area right outside the departures area of East Midlands Airport meet and greet parking."
          }
        },
        {
          "@type": "Question",
          "name": "How many miles will my car be driven?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Our average mileage is 10 miles and the maximum miles your vehicle may be driven is 15 miles (from collection to drop off)."
          }
        },
        {
          "@type": "Question",
          "name": "What if I have to return early?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "If your plans change and you have to return early, please give us as much notice as possible. You might have to wait longer than usual during peak hours."
          }
        },
        {
          "@type": "Question",
          "name": "What if I am delayed on my return?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "If your return is delayed, please keep us informed to avoid any delay in delivering your vehicle. You might have to wait longer than usual during peak hours."
          }
        }
      ]
    }
    </script>   
    <script defer type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Corporation",
        "name": "EMA Parking - Frequently Asked Questions ",
        "alternateName": "Frequently Asked Questions",
        "url": "https://emaparking.co.uk/frequently-asked-questions",
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
        "name": "Frequently Asked Questions",
        "speakable": {
            "@type": "SpeakableSpecification",
            "xPath": [
                "/html/head/title",
                "/html/head/meta[@name='description']/@content"
            ]
        },
        "url": "https://emaparking.co.uk/frequently-asked-questions"
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
            "name": "Frequently Asked Questions",
            "item": "https://emaparking.co.uk/frequently-asked-questions"
        }]
    }]
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "EMA Parking - Frequently Asked Questions",
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
        "name": "EMA Parking - Frequently Asked Questions",
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
        "url": " https://emaparking.co.uk/frequently-asked-questions",
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
                        <h1>Frequently Asked Questions</h1>
                        <div class="bt-option">
                            <a href="/">Home</a>
                            <span>FAQ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->
    <div class="bravo-faq-lists">
        <div class="container">
            <h2 class="title text-center mb40"></h2>
            <div class="row">
                <div class="col-md-6 mt-2 mb-4">
                    <div class="faq-item">
                        <h3><a><img class="alignnone wp-image-7754" src="/images/ico_quest.png" alt="img" width="35" height="35"></a>&nbsp; HOW WILL I KNOW THAT MY BOOKING IS CONFIRMED?</h3>
                        <p>
                            After you have completed your booking, you will receive a confirmation e-mail from Midlands Parking LTD.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-4">
                    <div class="faq-item">
                        <h3><a><img class="alignnone wp-image-7754" src="/images/ico_quest.png" alt="img" width="35" height="35"></a>&nbsp; WHERE WILL MY CAR BE PARKED?</h3>
                        <p>
                            Your car is parked in MIDLANDS car park which is 10 minutes from the airport. Our sites have awarded Park Mark and accessed by the police for safety.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-4">
                    <div class="faq-item">
                        <h3><a><img class="alignnone wp-image-7754" src="/images/ico_quest.png" alt="img" width="35" height="35"></a>&nbsp; WHO WILL I HAND OVER MY VEHICLE TO?</h3>
                        <p>
                            You will be greeted by a Midlands chauffeur at the airport, and they will take your vehicle away to be parked in our parking area.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-4">
                    <div class="faq-item">
                        <h3><a><img class="alignnone wp-image-7754" src="/images/ico_quest.png" alt="img" width="35" height="35"></a>&nbsp; HOW WILL I RECOGNISE MIDLANDSFLY PARKING CHAUFFEUR?</h3>
                        <p>
                            Our chauffeur will be wearing Midlands Parking black shirt and black trouser with company ID cards.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-4">
                    <div class="faq-item">
                        <h3><a><img class="alignnone wp-image-7754" src="/images/ico_quest.png" alt="img" width="35" height="35"></a>&nbsp; ARE MIDLANDSFLY PARKING DRIVERS INSURED?</h3>
                        <p>
                            Midlands chauffeur`s are fully insured and all midlands staff are covered with third party liability insurance.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-4">
                    <div class="faq-item">
                        <h3><a><img class="alignnone wp-image-7754" src="/images/ico_quest.png" alt="img" width="35" height="35"></a>&nbsp; WHERE WILL I HANDOVER MY CAR?</h3>
                        <p>
                            Our staff will meet you at the rapid drop off area right outside the departures area of east midlands airport meet and greet parking.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-4">
                    <div class="faq-item">
                        <h3><a><img class="alignnone wp-image-7754" src="/images/ico_quest.png" alt="img" width="35" height="35"></a>&nbsp; HOW MANY MILES MY CAR WILL BE DRIVEN?</h3>
                        <p>
                            Our average mileage is 10 miles and maximum miles your vehicle may be driven is 15miles (from collection to drop off)
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-4">
                    <div class="faq-item">
                        <h3><a><img class="alignnone wp-image-7754" src="/images/ico_quest.png" alt="img" width="35" height="35"></a>&nbsp; WHAT IF I HAVE TO RETURN EARLY?</h3>
                        <p>
                            If your plan changes and you have to return early , please give us as much notice possible . You might have to wait longer than usual during peak hours.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mb-4">
                    <div class="faq-item">
                        <h3><a><img class="alignnone wp-image-7754" src="/images/ico_quest.png" alt="img" width="35" height="35"></a>&nbsp; WHAT IF I AM DELAYED ON MY RETURN ?</h3>
                        <p>
                            If you return is delayed please keep us informed to avoid any delay in us delivering your vehicle. You might have to wait longer than usual during peak hours.
                        </p>
                        <p>If you have further queries, please check our <a href="https://emaparking.co.uk/page/terms-conditions">terms and conditions</a>, or send us your query at support@emaparking.co.uk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
