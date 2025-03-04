@php
    $translation = $row->translate();
@endphp

<div class="room-item transition-3d-hover shadow-hover-2" style="position: relative">
    <div class="featured bg-primary display-4 px-4">
        {!! $row->id==14 ? 'Flexible' : ($row->id==15 ? 'Non-Flexible' : ($row->id == 16 ? 'All Inclusive' : clean($translation->title))) !!}
    </div>
    <img height="250" src="{{$row->image_url}}" alt="">
    <div class="ri-text px-3 pt-0 "  style="text-align: justify; min-height: 550px;">
        <h4 class="my-0">

        </h4>
        <h3 class="mb-0"> <small class="mr-1 text-decoration-line-through text-danger font-weight-bold" style="font-size: 40px">
                {{$row->price_range_calculate_before_discount(Request::query('start'), Request::query('end'), Request::query('coupon')) }}
            </small>
            <span style="font-size: 26px" class="ms-2">
                        {{$row->price_range_calculate(Request::query('start'), Request::query('end'), Request::query('coupon')) }}
                    </span>
            <span style="font-size: 22px" class="mr-1 ">
                        @if($row->getBookingType()=="by_day")
                    {{__("/:number day(s)", ['number' =>$row->total_days_calculate(Request::query('start'), Request::query('end'))])}}
                @else
                    {{__("/night")}}
                @endif
                    </span></h3>
        <div class="d-flex justify-content-center">
            @if(Request::query('start') && Request::query('end'))
                @include('Space::frontend.layouts.details.space-form-book-single')
            @else
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><i class="fa fa-exclamation-triangle"></i></strong> Please select arrival & departure date to continue.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

<!--            <a href="{{$row->getDetailUrl($include_param ?? true)}}" class="btn btn-primary" tabindex="0">Book Now</a>-->
        </div>

        <ul style="text-align: justify;  min-height: 250px; >
            @if($row['id']==15)

                <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                    <div class="ml-2 d-block"><span> This is a non-flex product and cannot be cancelled/amended.</span>
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

            @elseif($row['id']==16)

                <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                    <div class="ml-2 d-block"><span> Midlands meet and greet all inclusive</span>
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
<!--                <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                    <div class="ml-2 d-block"><span> Airport charges apply £6 each way.</span>
                    </div>
                </li>-->
                <li class="d-flex"><i class="fa fa-check-circle text-primary mt-1" aria-hidden="true"></i>
                    <div class="ml-2 d-block"><span> VIP experience: ideal for families and business travelers.</span>
                    </div>
                </li>

            @else

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

            @endif



        </ul>
       
        <div class="d-flex flex-wrap align-items-center justify-content-center pt-2">
            @php
                $terms_ids = $row->terms->pluck('term_id');
                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
            @endphp
            @if(!empty($terms_ids) and !empty($attributes))
               @php $counter = 0; @endphp
            @foreach($attributes as $attribute)
                @php $translate_attribute = $attribute['parent']->translate(); @endphp
                @if($translate_attribute->name == 'Space Type')
                    @continue
                @endif
                @if(empty($attribute['parent']['hide_in_single']))
                    @php $terms = $attribute['child']; @endphp
                    @foreach($terms as $term)
                        @if($counter >= 8)
                            @break
                        @endif
                        @php 
                            $translate_term = $term->translate(); 
                            $counter++;
                        @endphp
                        <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{$translate_term->name}}">
                            @if(!empty($term->image_id))
                                @php $image_url = get_file_url($term->image_id, 'full'); @endphp
                                <img src="{{$image_url}}" class="img-responsive" alt="{{$translate_term->name}}">
                            @else
                                <i class="text-white {{ $term->icon ?? "flaticon-tick icon-default"}}" aria-hidden="true"></i>
                            @endif
                        </div>
                    @endforeach
                @endif
                @if($counter >= 8)
                    @break
                @endif
            @endforeach

            @endif
            {{--    <div class="mr-2 mb-2 bg-primary rounded p-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="CCTV">
                    <i class="text-white icofont-video-cam" aria-hidden="true"></i>
                </div>--}}

        </div>

<!--        <div class="d-flex justify-content-center my-2">
            <div class="d-flex flex-column" style="">
                <img src="https://www.travelairportplus.co.uk/images/upload/awards/1483704314-park_mark_award.png" class="img-responsive">
                <img style="height: 58px;" src="https://www.travelairportplus.co.uk/images/upload/awards/1510839229-1490627135-bpa.jpg" class="img-responsive">
            </div>

        </div>-->
        <a class="primary-btn spaceDetails" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{$row->id}}" >More Details</a>

    </div>
</div>

@push('js')
    <script>
        var bravo_booking_data = {!! json_encode($row->getBookingData()) !!}
            var bravo_booking_i18n = {
            no_date_select:'{{__('Please select Start and End date')}}',
            no_guest_select:'{{__('Please select at least one guest')}}',
            load_dates_url:'{{route('space.vendor.availability.loadDates')}}',
            name_required:'{{ __("Name is Required") }}',
            email_required:'{{ __("Email is Required") }}',
        };
    </script>
    <script type="text/javascript" src="{{ asset('themes/mytravel/module/space/js/single-space2.js?_ver='.config('app.asset_version')) }}"></script>
@endpush

