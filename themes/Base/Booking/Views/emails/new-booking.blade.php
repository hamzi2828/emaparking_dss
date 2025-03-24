@extends('Email::layout')
@section('content')

    <div class="b-container">
        <div class="b-panel">
            @switch($to)
                @case ('admin')
                    <h3 class="email-headline"><strong>{{__('Hello Administrator')}}</strong></h3>
                    <p>{{__('New booking has been made')}}</p>
                @break
                @case ('vendor')
                    <h3 class="email-headline"><strong>{{__('Hello :name',['name'=>$booking->vendor->nameOrEmail ?? ''])}}</strong></h3>
                    <p>{{__('Your service has new booking')}}</p>
                @break

                @case ('customer')
                    <h3 class="email-headline"><strong>{{__('Hello :name',['name'=>$booking->first_name ?? ''])}}</strong></h3>
                    <p>{{__('You recently booked with us, but the payment is not completed. If you have done another booking, please ignore this message.')}}</p>
                    <p>{{__('However, if you would like to complete this booking, please click the "booking details" button below to process the payment.')}}</p>
                @break

            @endswitch

            @include($service->email_new_booking_file ?? '')
        </div>
        @include('Booking::emails.parts.panel-customer')
        @include('Booking::emails.parts.panel-vehicle')
        @include('Booking::emails.parts.panel-flight')
       {{-- @include('Booking::emails.parts.panel-passengers')--}}
    </div>
@endsection
