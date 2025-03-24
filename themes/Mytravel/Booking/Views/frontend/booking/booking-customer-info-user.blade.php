<div class="pt-4 pb-5 px-5 border-bottom booking-review">
<!--    <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
        {{ __("Your Information") }}
    </h5>-->
    <!-- Fact List -->
    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
        <h3>Customer Details</h3>
        <div class="row">

            <div class="col-md-4">
                <li class="info-first-name d-flex justify-content-start py-2">
                    <div class="label">{{__('Name: ')}}</div>
                    <div class="val">&nbsp;{{$booking->first_name}} {{$booking->last_name}}</div>
                </li>
            </div>
            <div class="col-md-4">
                <li class="info-city d-flex justify-content-start py-2">
                    <div class="label">{{__('City:')}}</div>
                    <div class="val">&nbsp;{{$booking->city}}</div>
                </li>
            </div>
            <div class="col-md-4">
                <li class="info-country d-flex justify-content-start py-2">
                    <div class="label">{{__('Country:')}}</div>
                    <div class="val">&nbsp;{{get_country_name($booking->country)}}</div>
                </li>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <li class="info-email d-flex justify-content-start py-2">
                    <div class="label">{{__('Email: ')}}</div>
                    <div class="val">&nbsp;{{$booking->email}}</div>
                </li>
            </div>
            <div class="col-md-4">
                <li class="info-phone d-flex justify-content-start py-2">
                    <div class="label">{{__('Phone:')}}</div>
                    <div class="val">&nbsp;{{$booking->phone}}</div>
                </li>
            </div>
        </div>
        <h3 class="mt-4">Vehicle Details</h3>
        <div class="row">
            <div class="col-md-3">
                <li class="info-email d-flex justify-content-start py-2">
                    <div class="label">{{__('Registration: ')}}</div>
                    <div class="val">&nbsp;{{$booking->vehicle_registration}}</div>
                </li>
            </div>
            <div class="col-md-3">
                <li class="info-phone d-flex justify-content-start py-2">
                    <div class="label">{{__('Manufacture:')}}</div>
                    <div class="val">&nbsp;{{$booking->vehicle_manufacture}}</div>
                </li>
            </div>
            <div class="col-md-3">
                <li class="info-email d-flex justify-content-start py-2">
                    <div class="label">{{__('Model: ')}}</div>
                    <div class="val">&nbsp;{{$booking->vehicle_model}}</div>
                </li>
            </div>
            <div class="col-md-3">
                <li class="info-phone d-flex justify-content-start py-2">
                    <div class="label">{{__('Color:')}}</div>
                    <div class="val">&nbsp;{{$booking->vehicle_color}}</div>
                </li>
            </div>
        </div>
        <h3 class="mt-4">Flight & Timing Details</h3>
        <div class="row">
            <div class="col-md-12">
                <li class="info-email d-flex justify-content-start py-2">
                    <div class="label">{{__('Flight No: ')}}</div>
                    <div class="val">&nbsp;{{$booking->flight_no}}</div>
                </li>
            </div>
            <div class="col-md-6">
                <li class="info-phone d-flex justify-content-start py-2">
                    <div class="label">{{__('Arrival:')}}</div>
                    <div class="val">&nbsp;{{$booking->start_date}}</div>
                </li>
            </div>
            <div class="col-md-6">
                <li class="info-email d-flex justify-content-start py-2">
                    <div class="label">{{__('Departure: ')}}</div>
                    <div class="val">&nbsp;{{$booking->end_date}}</div>
                </li>
            </div>
        </div>








    </ul>
    <!-- End Fact List -->
</div>
