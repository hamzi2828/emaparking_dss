@extends('layouts.app')
@push('css')
    <link href="{{ asset('dist/frontend/module/booking/css/checkout.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
@endpush
@section('content')
    <div class="bravo-booking-page padding-content ">
        <div class="container">
            <div class="row booking-success-notice">
                <div class="col-lg-8 col-xl-9">
                    <div class="mb-5 shadow-soft bg-white rounded-sm">
                        <div class="py-6 px-5 border-bottom">
                            <div class="flex-horizontal-center">
                                @switch($booking->status)
                                    @case(\Modules\Booking\Models\Booking::COMPLETED)
                                    @case(\Modules\Booking\Models\Booking::PROCESSING)
                                    @case(\Modules\Booking\Models\Booking::CONFIRMED)
                                    @case(\Modules\Booking\Models\Booking::CONFIRMED)

                                        <div class="height-50 width-50 flex-shrink-0 flex-content-center bg-primary rounded-circle">
                                            <i class="flaticon-tick text-white font-size-24"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="font-size-18 font-weight-bold text-dark mb-0 text-lh-sm">
                                                {{__('Thank You. Your booking was submitted successfully!')}}
                                            </h3>
                                            <p class="mb-0">
                                                {{__('Booking details has been sent to:')}} <span><a href="mailto:{{$booking->email}}">{{$booking->email}}</a></span>
                                            </p>
                                            @if($note = $gateway->getOption("payment_note"))
                                                <p class="mb-0">
                                                    {!! clean($note) !!}
                                                </p>
                                            @endif
                                        </div>
                                        @break
                                    @default
                                        <div class="height-50 width-50 flex-shrink-0 flex-content-center bg-primary rounded-circle">
                                            <i class=" fa fa-warning text-white font-size-24"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="font-size-18 font-weight-bold text-dark mb-0 text-lh-sm">
                                                {{__('Your booking status is: :status',['status'=>booking_status_to_text($booking->status)])}}
                                            </h3>
                                        </div>
                                        @break
                                @endswitch
                            </div>
                        </div>
                        @include ($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info')
                        @include ($service->booking_customer_info_file ?? 'Booking::frontend/booking/panel-vehicle')
                        @include ($service->booking_customer_info_file ?? 'Booking::frontend/booking/panel-flight')
                        <div class="text-right py-4 pr-4">
                            @if(auth()->user() != null)
                                <a href="{{route('user.booking_history')}}" class="btn btn-primary rounded-sm transition-3d-hover font-size-16 font-weight-bold py-3">{{__('Booking History')}}</a>
                            @endif
                            @if($booking->total > $booking->paid && $booking->gateway == 'stripe')
                                <form action="{{route('booking.payNow')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$booking->id}}">
                                    <button type="submit" class="btn btn-success">Pay Now</button>
                                </form>
                            @endif
                        </div>


                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    @include ($service->checkout_booking_detail_file ?? '')
                </div>
            </div>
        </div>
    </div>
@endsection
