@php $lang_local = app()->getLocale() @endphp

<div class="shadow-soft bg-white rounded-sm booking-review">

    <div id="basicsAccordionBooking">
        <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
            <div class="card-header card-collapse bg-transparent border-0">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark" data-toggle="collapse" data-target="#basicsCollapseDetail">
                        {{ __("Booking Detail") }}
                        <span class="card-btn-arrow font-size-14 text-dark"><i class="fa fa-chevron-down"></i></span>
                    </button>
                </h5>
            </div>
            <div id="basicsCollapseDetail" class="collapse show" data-parent="#basicsAccordionBooking">
                <div class="card-body px-4 pt-0">
                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">

                        <li class="d-flex justify-content-between py-2">
                            <div class="label">{{__('Reference No:')}}</div>
                            <div class="val">
                                {{$booking->reference_no}}
                            </div>
                        </li>
                        @if($booking->start_date)
                            @if(auth()->user() != null && auth()->user()->role_id ==1)
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">{{__('Arrival:')}}</div>
                                    <div class="val">
                                        {{$booking->start_date}}
                                    </div>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">{{__('Departure:')}}</div>
                                    <div class="val">
                                        {{$booking->end_date}}
                                    </div>
                                </li>
                            @else
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">{{__('Arrival:')}}</div>
                                    <div class="val">
                                        {{\Carbon\Carbon::parse($booking->start_date)->format('m/d/Y')}}
                                    </div>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">{{__('Departure:')}}</div>
                                    <div class="val">
                                        {{\Carbon\Carbon::parse($booking->end_date)->format('m/d/Y')}}
                                    </div>
                                </li>
                            @endif
                        @endif

                        @if($booking->getMeta("booking_type") == "by_day")
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Days:')}}</div>
                                <div class="val">
                                    {{$booking->duration_days}}
                                </div>
                            </li>
                        @endif

                        @if(auth()->user() != null && auth()->user()->role_id ==1)
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Flight no:')}}</div>
                                <div class="val">
                                    {{$booking->flight_no}}
                                </div>
                            </li>
                        @endif
                        {{--@if($booking->getMeta("booking_type") == "by_night")
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Nights:')}}</div>
                                <div class="val">
                                    {{$booking->duration_nights}}
                                </div>
                            </li>
                        @endif--}}
                        {{--@if($meta = $booking->getMeta('adults'))
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Adults:')}}</div>
                                <div class="val">
                                    {{$meta}}
                                </div>
                            </li>
                        @endif
                        @if($meta = $booking->getMeta('children'))
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Children:')}}</div>
                                <div class="val">
                                    {{$meta}}
                                </div>
                            </li>
                        @endif--}}
<!--                        <li class="flex-wrap">
                            <div class="flex-grow-0 flex-shrink-0 w-100">
                                <p class="text-center">
                                    <a data-toggle="modal" data-target="#detailBookingDate{{$booking->code}}" aria-expanded="false"
                                       aria-controls="detailBookingDate{{$booking->code}}">
                                        {{__('Detail')}} <i class="icofont-list"></i>
                                    </a>
                                </p>
                            </div>
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
        @if(auth()->user() != null && auth()->user()->role_id ==1)

        <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
            <div class="card-header card-collapse bg-transparent border-0">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark" data-toggle="collapse" data-target="#basicsCollapseDetail2">
                        {{ __("Vehicle Detail") }}
                        <span class="card-btn-arrow font-size-14 text-dark"><i class="fa fa-chevron-down"></i></span>
                    </button>
                </h5>
            </div>
            <div id="basicsCollapseDetail2" class="collapse show" data-parent="#basicsAccordionBooking">
                <div class="card-body px-4 pt-0">
                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Registration:')}}</div>
                                <div class="val">
                                    {{$booking->vehicle_registration}}
                                </div>
                            </li>
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Manufacture:')}}</div>
                                <div class="val">
                                    {{$booking->vehicle_manufacture}}
                                </div>
                            </li>
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Model:')}}</div>
                                <div class="val">
                                    {{$booking->vehicle_model}}
                                </div>
                            </li>
                        <li class="d-flex justify-content-between py-2">
                            <div class="label">{{__('Color:')}}</div>
                            <div class="val">
                                {{$booking->vehicle_color}}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endif
        <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
            <div class="card-header card-collapse bg-transparent border-0" id="basicsHeadingFour">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark" data-toggle="collapse" data-target="#basicsCollapsePayment">
                        {{ __("Payment") }}
                        <span class="card-btn-arrow font-size-14 text-dark"><i class="fa fa-chevron-down"></i></span>
                    </button>
                </h5>
            </div>
            <div id="basicsCollapsePayment" class="collapse show">
                <div class="card-body px-4 pt-0">
                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                        @php
                            $price_item = $booking->total_before_extra_price;
                        @endphp
                        @if(!empty($price_item))
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Booking price')}}
                                </div>
                                <div class="val">
                                    {{format_money( $price_item)}}
                                </div>
                            </li>
                        @endif
                        @php $extra_price = $booking->getJsonMeta('extra_price') @endphp
                        @if(!empty($extra_price))
                            <li class="d-flex justify-content-between py-2">
                                <div class="font-size-16 font-weight-bold">
                                    {{__("Extra Prices:")}}
                                </div>
                            </li>
                            @foreach($extra_price as $type)
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">{{$type['name_'.$lang_local] ?? __($type['name'])}}:</div>
                                    <div class="val">
                                        {{format_money($type['total'] ?? 0)}}
                                    </div>
                                </li>
                            @endforeach
                        @endif
                        @php
                            $list_all_fee = [];
                            if(!empty($booking->buyer_fees)){
                                $buyer_fees = json_decode($booking->buyer_fees , true);
                                $list_all_fee = $buyer_fees;
                            }
                            if(!empty($vendor_service_fee = $booking->vendor_service_fee)){
                                $list_all_fee = array_merge($list_all_fee , $vendor_service_fee);
                            }
                        @endphp
                        @if(!empty($list_all_fee))
                            @foreach ($list_all_fee as $item)
                                @php
                                    $fee_price = $item['price'];
                                    if(!empty($item['unit']) and $item['unit'] == "percent"){
                                        $fee_price = ( $booking->total_before_fees / 100 ) * $item['price'];
                                    }
                                @endphp
                                <li class="d-flex justify-content-between py-2">
                                    <div class="font-size-16 font-weight-bold">
                                        {{__("Fee:")}}
                                    </div>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">
                                        {{$item['name_'.$lang_local] ?? $item['name']}}
                                        <i class="icofont-info-circle" data-toggle="tooltip" data-placement="top" title="{{ $item['desc_'.$lang_local] ?? $item['desc'] }}"></i>
                                        @if(!empty($item['per_person']) and $item['per_person'] == "on")
                                            : {{$booking->total_guests}} * {{format_money( $fee_price )}}
                                        @endif
                                    </div>
                                    <div class="val">
                                        @if(!empty($item['per_person']) and $item['per_person'] == "on")
                                            {{ format_money( $fee_price * $booking->total_guests ) }}
                                        @else
                                            {{ format_money( $fee_price ) }}
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        @endif
                        @includeIf('Coupon::frontend/booking/checkout-coupon')
                        <li class="d-flex justify-content-between py-2">
                            <div class="label">{{__("Total:")}}</div>
                            <div class="val">{{format_money($booking->total)}}</div>
                        </li>
                        @if($booking->status !='draft')
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__("Paid:")}}</div>
                                <div class="val">{{format_money($booking->paid)}}</div>
                            </li>
                            @if($booking->paid < $booking->total )
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">{{__("Remain:")}}</div>
                                    <div class="val">{{format_money($booking->total - $booking->paid)}}</div>
                                </li>
                            @endif
                        @endif
                        @include ('Booking::frontend/booking/checkout-deposit-amount')
                    </ul>
                </div>
            </div>
        </div>
        @if(auth()->user() != null && auth()->user()->role_id ==1)
        <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
            <div class="card-header card-collapse bg-transparent border-0">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark" data-toggle="collapse" data-target="#basicsCollapseDetail3">
                        {{ __("Check in - Check out Detail") }}
                        <span class="card-btn-arrow font-size-14 text-dark"><i class="fa fa-chevron-down"></i></span>
                    </button>
                </h5>
            </div>
            <div id="basicsCollapseDetail3" class="collapse show" data-parent="#basicsAccordionBooking">
                <div class="card-body px-4 pt-0">
                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                        <li class="row py-2">
                            <div class="col-md-6 d-flex justify-content-between">
                                <div class="label">{{__('Collection Time:')}}</div>
                                <div class="val">
                                    {{$booking->collection_time}}
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between">
                                <div class="label">{{__('Collection Driver Name:')}}</div>
                                <div class="val">
                                    {{$booking->collection_driver}}
                                </div>
                            </div>

                        </li>

                        <li class="row py-2">
                            <div class="col-md-6 d-flex justify-content-between">
                                <div class="label">{{__('Return Time:')}}</div>
                                <div class="val">
                                    {{$booking->return_time}}
                                </div>
                            </div>
                            <div class="col-md-6  d-flex justify-content-between">
                                <div class="label">{{__('Return Driver Name:')}}</div>
                                <div class="val">
                                    {{$booking->return_driver}}
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>




