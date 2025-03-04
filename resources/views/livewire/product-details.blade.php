<div class="modal-content">
    @if($row!=null)
        <!-- Modal Header -->
        <div class="modal-header d-flex justify-content-between align-items-start">
            <!-- Product Image -->
            <div class="d-flex flex-wrap align-items-start">
                <img src="{{$row->image_url}}" alt="Product Image" class="mr-3 Product-Image">

                <!-- Custom Product Review Stars -->
                <div>
                    @php $review_score = $row->review_data @endphp
                    <div class="d-flex justify-content-center">
                        <div class="custom-product-stars">
                            @php $score = $review_score['score_total'] @endphp
                            @php
                                $filledStars = floor($score);
                                $halfFilled = $score - $filledStars;
                                $emptyStars = 5 - $filledStars - ceil($halfFilled);
                            @endphp

                            @for ($i = 0; $i < $filledStars; $i++)
                                <svg role="img" width="19" height="19" viewBox="2 2 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Filled star</title><defs><clipPath id="clip-1hjknto3n0dbfa1b08003eb"><rect width="8" height="7.6636257" x="3.9863169" y="4.3568988"></rect></clipPath></defs><g id="decimal-star"><path id="border-star" fill-rule="evenodd" clip-rule="evenodd" d="M 13.3854,6.01933 10.1084,5.52017 8.64374,2.41743 c -0.26243,-0.55305 -1.0228,-0.56008 -1.28748,0 L 5.89159,5.52017 2.61459,6.01933 C 2.02693,6.10838 1.79141,6.86532 2.21758,7.29886 L 4.58842,9.71263 4.02767,13.1224 c -0.10093,0.6163 0.52037,1.078 1.04075,0.7897 L 8,12.3021 l 2.9316,1.61 c 0.5204,0.2859 1.1417,-0.1734 1.0407,-0.7897 L 11.4116,9.71263 13.7824,7.29886 C 14.2086,6.86532 13.9731,6.10838 13.3854,6.01933 Z M 10.238,11.8199 9.80791,9.20473 11.6987,7.27971 9.09291,6.88279 8,4.56758 6.90709,6.88279 4.30131,7.27971 6.19209,9.20473 5.76202,11.8199 8,10.5908 Z" style="fill: rgb(255, 208, 0); fill-opacity: 1;"></path><path id="inner" d="M 10.365089,11.940869 9.9112316,9.2401755 11.906508,7.2522018 9.1567203,6.8423012 8.0034155,4.4513771 6.8501108,6.8423012 4.100334,7.2522018 6.0955995,9.2401755 5.6417636,11.940869 8.0034155,10.671574 Z" style="fill: rgb(255, 208, 0); clip-path: url(&quot;#clip-1hjknto3n0dbfa1b08003eb&quot;);"></path></g></svg>
                            @endfor

                            @if ($halfFilled > 0)
                                <svg role="img" width="19" height="19" viewBox="2 2 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Partial star</title><defs><clipPath id="clip-1hjknrnk10dc3def344c1cd"><rect width="4.04" height="7.6636257" x="3.9863169" y="4.3568988"></rect></clipPath></defs><g id="decimal-star"><path id="border-star" fill-rule="evenodd" clip-rule="evenodd" d="M 13.3854,6.01933 10.1084,5.52017 8.64374,2.41743 c -0.26243,-0.55305 -1.0228,-0.56008 -1.28748,0 L 5.89159,5.52017 2.61459,6.01933 C 2.02693,6.10838 1.79141,6.86532 2.21758,7.29886 L 4.58842,9.71263 4.02767,13.1224 c -0.10093,0.6163 0.52037,1.078 1.04075,0.7897 L 8,12.3021 l 2.9316,1.61 c 0.5204,0.2859 1.1417,-0.1734 1.0407,-0.7897 L 11.4116,9.71263 13.7824,7.29886 C 14.2086,6.86532 13.9731,6.10838 13.3854,6.01933 Z M 10.238,11.8199 9.80791,9.20473 11.6987,7.27971 9.09291,6.88279 8,4.56758 6.90709,6.88279 4.30131,7.27971 6.19209,9.20473 5.76202,11.8199 8,10.5908 Z" style="fill: rgb(255, 208, 0); fill-opacity: 1;"></path><path id="inner" d="M 10.365089,11.940869 9.9112316,9.2401755 11.906508,7.2522018 9.1567203,6.8423012 8.0034155,4.4513771 6.8501108,6.8423012 4.100334,7.2522018 6.0955995,9.2401755 5.6417636,11.940869 8.0034155,10.671574 Z" style="fill: rgb(255, 208, 0); clip-path: url(&quot;#clip-1hjknrnk10dc3def344c1cd&quot;);"></path></g></svg>
                            @endif

                            @for ($i = 0; $i < $emptyStars; $i++)
                                <svg role="img" width="19" height="19" viewBox="2 2 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Empty star</title><g id="decimal-star"><path id="border-star" fill-rule="evenodd" clip-rule="evenodd" d="M 13.3854,6.01933 10.1084,5.52017 8.64374,2.41743 c -0.26243,-0.55305 -1.0228,-0.56008 -1.28748,0 L 5.89159,5.52017 2.61459,6.01933 C 2.02693,6.10838 1.79141,6.86532 2.21758,7.29886 L 4.58842,9.71263 4.02767,13.1224 c -0.10093,0.6163 0.52037,1.078 1.04075,0.7897 L 8,12.3021 l 2.9316,1.61 c 0.5204,0.2859 1.1417,-0.1734 1.0407,-0.7897 L 11.4116,9.71263 13.7824,7.29886 C 14.2086,6.86532 13.9731,6.10838 13.3854,6.01933 Z M 10.238,11.8199 9.80791,9.20473 11.6987,7.27971 9.09291,6.88279 8,4.56758 6.90709,6.88279 4.30131,7.27971 6.19209,9.20473 5.76202,11.8199 8,10.5908 Z" style="fill: rgb(255, 208, 0); fill-opacity: 1;"></path><path id="inner" d="M 10.365089,11.940869 9.9112316,9.2401755 11.906508,7.2522018 9.1567203,6.8423012 8.0034155,4.4513771 6.8501108,6.8423012 4.100334,7.2522018 6.0955995,9.2401755 5.6417636,11.940869 8.0034155,10.671574 Z"></path></g></svg>
                            @endfor
                        </div>

                        <!-- Number of Reviews -->
                        <span class="ml-2">({{$review_score['total_review']}})</span>
                    </div>
                    <h5 class="modal-title mt-2 text-white">{!! clean($translation->title) !!}</h5>
                </div>
            </div>

            <!-- Close Button -->
            <button type="button" class="text-white btn m-0 p-0" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times fs-2"></i></button>
        </div>

        <div class="modal-body">
            <!-- Tabs navigation -->
            <ul class="nav nav-tabs d-flex justify-content-center" id="myTabs">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1" data-bs-toggle="tab" href="#tab-content1">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2" data-bs-toggle="tab" href="#tab-content2">On Arrival</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab3" data-bs-toggle="tab" href="#tab-content3">On Return</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab4" data-bs-toggle="tab" href="#tab-content4">Directions & Map</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab5" data-bs-toggle="tab" href="#tab-content5">Reviews</a>
                </li>
            </ul>

            <!-- Tabs content -->
            <div class="tab-content m-2 p-2">
                <div class="tab-pane fade show active" id="tab-content1">
                    <p class="p-md-0 p-2">Midlands Airport Meet and Greet prides itself in being the most affordable, secure, and customer-friendly parking provider for East Midlands Airport. Midlands Parking offers great facilities for Chauffeured Parking.

                        Our car park has Safer Parking status, Park Mark, which is awarded to parking facilities that have met the requirements of a risk assessment conducted by the police and we are open 365 days a year 24/7.

                        Our car park is approved by the British Parking Association and by the police. Providing 24/7 CCTV in operation, fully fenced, gate, barrier, and Manned security round the clock.</p>
                    <br>
                    <h4>Why Book Midlands Meet and Greet?</h4>
                    <ul class="ml-5">
                        <li>No transfers are needed you are met at Short Stay Car Park 1.</li>
                        <li>Park Mark Award with secure perimeter fencing.</li>
                        <li>Excellent customer service.</li>
                        <li>Ideal for Business travellers.</li>
                        <li>Serving 24-hour secure parking at a competitive price.</li>
                        <li>The car park is situated close to the Airport.</li>
                        @if($row->id!=16)
                            <li>Airport charges apply £6 each way (for 30mins).</li>
                        @endif
                    </ul>
                    <br>
                    <h4>Additional Info</h4>
                    <p class="p-md-0 p-2">
                        Help us go green! There's no need to print out your booking confirmation, just show it on your mobile device.



                        Please arrive at least 30 minutes before your earliest recommended check-in time.

                        @if($row->id!=16)
                        Airport charges are payable at the drop-off / Collection £6 for 30 mins. We accept cash / All major cards.
                        @endif



                        Car Park accepts larger vehicles ie. Camper Van, 18ft long, 10ft high. If it fits into a normal car parking space. No long-based vehicles or over 2 meters wide.

                        Your vehicle will be stored in our secure compound 3.9 miles from the drop-off location. Your vehicle may be driven up to 20 miles round trip.
                    </p>

                </div>
                <div class="tab-pane fade" id="tab-content2">
                    <h4>On Arrival</h4>
                    <p class="p-md-0 p-2">30 minutes before arrival at the airport, call the chauffeur on <span style="color: red">07889622681</span> and they will arrange to meet you at the Short Stay1 at the airport.
                        <br><br>
                        When you approach the terminal, stay in the extreme left-hand lane (Marked Short Stay 1-- Ignore the signs of meet & greet) follow the lane take the token at the barrier, and park in row C next to the pay station where our staff will meet you.
                        <br><br>
                        Once there, they will check the details of your return. Our representative will make a brief video of your vehicle upon collection and take your car to be stored in our car park for the duration of your trip. From there it's 2 minutes’ walk to the departures.
                        <br><br>
                        @if($row->id!=16)
                        Airport charges are payable at the drop-off / Collection £6 for 30 mins. We accept cash / All major cards.
                        <br><br>
                        @endif
                        Car Park accepts larger vehicles ie. Camper Van, 18ft long, 10ft high. If it fits into a normal car parking space. No long-based vehicles or over 2 meters wide.</p>
                </div>
                <div class="tab-pane fade" id="tab-content3">
                    <h4>On Return</h4>
                    <p class="p-md-0 p-2">Simply call the chauffeur on your return on <span style="color: red">07889622681</span>. Let them know you have collected your luggage and cleared customs. They will be waiting at Short Stay 1-row C next to the pay station area with your vehicle within 15-20 minutes.
                        <br><br>
                        @if($row->id!=16)
                        On leaving Short Stay 1 area you would pay airport charges £6.00 at the barrier or at pay station.
                        @endif
                    </p>
                </div>
                <div class="tab-pane fade" id="tab-content4">
                    <h4>Directions</h4>
                    <p class="p-md-0 p-2">
                        East Midlands Airport (EMA),<br>
                        Castle Donington,<br>
                        Derby <br>
                        DE74 2SA
                    </p>
                    <br>
                    <h4>Locate on Map</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2410.6110297570026!2d-1.334708923781277!3d52.829373972143856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4879e5b2f87b0e53%3A0x32972cb4ce3df85!2sEast%20Midlands%20Airport!5e0!3m2!1sen!2s!4v1704718607979!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="tab-pane fade" id="tab-content5">
                    @if(setting_item($row->type."_enable_review"))
                        <div class="bravo-reviews">
                            <div class="border-bottom py-4">
                                <h5 id="scroll-reviews" class="font-size-21 font-weight-bold text-dark mb-4">
                                    {{__("Reviews")}}
                                </h5>
                                @if($review_score)
                                    <div class="row">
                                        <div class="col-md-4 mb-4 mb-md-0">
                                            <div class="border rounded flex-content-center py-5 border-width-2">
                                                <div class="text-center">
                                                    <h2 class="font-size-50 font-weight-bold text-primary mb-0 text-lh-sm">
                                                        {{$review_score['score_total']}}<span class="font-size-20">/5</span>
                                                    </h2>
                                                    <div class="font-size-25 text-dark mb-3">{{$review_score['score_text']}}</div>
                                                    <div class="text-gray-1">{{__("From")}}
                                                        @if($review_score['total_review'] > 1)
                                                            {{ __(":number reviews",["number"=>$review_score['total_review'] ]) }}
                                                        @else
                                                            {{ __(":number review",["number"=>$review_score['total_review'] ]) }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                @if($review_score['rate_score'])
                                                    @foreach($review_score['rate_score'] as $item)
                                                        <div class="col-md-6 mb-4">
                                                            <h6 class="font-weight-normal text-gray-1 mb-1">
                                                                {{$item['title']}}
                                                            </h6>
                                                            <div class="flex-horizontal-center mr-6">
                                                                <div class="progress bg-gray-33 rounded-pill w-100" style="height: 7px;">
                                                                    <div class="progress-bar rounded-pill" role="progressbar" style="width: {{$item['percent']}}%;" aria-valuenow="{{$item['percent']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <div class="ml-3 text-primary font-weight-bold">
                                                                    {{$item['total']}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="stickyBlockEndPoint"></div>
                            <div class="@if(!isset($bookingModal) || $bookingModal==false) border-bottom @endif py-4">

                                <livewire:product-reviews :space_id="$row->id"></livewire:product-reviews>
                                {{--@if($review_list->total() > 0)
                                    <div class="bravo-pagination">
                                        {{$review_list->appends(request()->query())->fragment('review-list')->links()}}
                                    </div>
                                @endif--}}
                            </div>
                            @if(!isset($bookingModal) || $bookingModal==false)
                                <div class="py-4">
                                    @if($row->check_enable_review_after_booking() and Auth::id())
                                        <h5 class="font-size-21 font-weight-bold text-dark mb-6">
                                            {{__("Write a review")}}
                                        </h5>
                                        <div class="form-wrapper">

                                            <form action="{{ route('review.store')}}" class="needs-validation sfeedbacks_form" novalidate method="post">
                                                @csrf
                                                <div class="row mb-5 mb-lg-0">
                                                    <div class="col-sm-12">
                                                        @include('admin.message')
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            @if($tour_review_stats = setting_item($row->type."_review_stats"))
                                                                @php $tour_review_stats = json_decode($tour_review_stats) @endphp
                                                                @foreach($tour_review_stats as $item)
                                                                    <div class="col-md-4 mb-6">
                                                                        <h6 class="font-weight-bold text-dark mb-1">
                                                                            {{$item->title}}
                                                                        </h6>
                                                                        <input class="review_stats" type="hidden" name="review_stats[{{$item->title}}]">
                                                                        <span class="font-size-20 letter-spacing-3 sspd_review">
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                    </span>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="col-md-4 mb-6">
                                                                    <h6 class="font-weight-bold text-dark mb-1">
                                                                        {{__("Review rate")}}
                                                                    </h6>
                                                                    <input class="review_stats" type="hidden" name="review_rate">
                                                                    <span class="font-size-20 letter-spacing-3 sspd_review">
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 mb-5">
                                                        <div class="js-form-message">
                                                            <input type="text" class="form-control" name="review_title" placeholder="{{__("Title")}}" required data-error-class="u-has-error" data-msg="{{__('Review title is required')}}" data-success-class="u-has-success">
                                                            <div class="invalid-feedback">{{__('Review title is required')}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 mb-5">
                                                        <div class="js-form-message">
                                                            <div class="input-group">
                                                                <textarea class="form-control" rows="6" cols="77" name="review_content" placeholder="{{__("Review content")}}" required data-msg="{{__('Review content has at least 10 character')}}" data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                                                <div class="invalid-feedback">{{__('Review content has at least 10 character')}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col d-flex justify-content-center justify-content-lg-start">
                                                        <button type="submit" id="submit" name="submit" class="btn rounded-xs bg-blue-dark-1 text-white p-2 height-51 width-190 transition-3d-hover">{{__("Leave a Review")}}</button>
                                                        <input type="hidden" name="review_service_id" value="{{$row->id}}">
                                                        <input type="hidden" name="review_service_type" value="{{ $row->type }}">
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    @endif
                                    @if((!isset($bookingModal) || $bookingModal==false) && !Auth::id())
                                        <div class="review-message">
                                            {!!  __("You must <a href='#login' data-toggle='modal' data-target='#login'>log in</a> to write review") !!}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <style>
            /* Add your custom styles here */
            .productModal .modal-header {
                background-color: #007bff;
                padding: 25px;
                color: white !important;
                border-bottom: none;
            }
            .Product-Image {
                max-width: 200px;
                }

            @media (max-width: 600px) {
                .Product-Image {
                     max-width: 100% !important;
                                 }
                        }
          .productModal .nav-tabs {
                background-color: #007bff;
                border: none;
            }

            .productModal .nav-tabs .nav-link {
                color: white;
                margin-left: 2px;
                border: 1px solid #007bff;
                border-bottom: none;
            }

            .productModal .nav-tabs .nav-link:hover {
                border: 1px solid white;
                border-bottom: none;
            }

            .productModal .nav-tabs .nav-link.active {
                background-color: white;
                color: #007bff;
            }
            .productModal #myTabs {
                background-color: #007bff;
            }
            .productModal .modal-body {
                padding: 0;
            }

            .productModal .nav-tabs .nav-link.active {
                border-bottom: none;
            }
            @media (max-width: 800px) {
            .productModal .modal-header, 
            .productModal .modal-body {
                text-align: justify; 
            }
}

        </style>
    @endif
</div>

