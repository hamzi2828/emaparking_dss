
<div class="pt-4 pb-5 px-5 border-bottom booking-review">
    <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
        {{ __("Flight & Timing Details") }}
    </h5>
    <!-- Fact List -->
    <ul class="list-unstyled font-size-1 mb-0 font-size-16">




        <li class="info-first-name d-flex justify-content-between py-2">
            <div class="label">{{__('Flight No: ')}}</div>
            <div class="val">{{$booking->flight_no}}</div>
        </li>
        <li class="info-email d-flex justify-content-between py-2">
            <div class="label">{{__('Arrival Time: ')}}</div>
            <div class="val">&nbsp;{{\Carbon\Carbon::parse($booking->start_date)->format('g:i A')}}</div>
        </li>
        <li class="info-phone d-flex justify-content-between py-2">
            <div class="label">{{__('Departure Time:')}}</div>
            <div class="val">&nbsp;{{\Carbon\Carbon::parse($booking->end_date)->format('g:i A')}}</div>
        </li>

    </ul>
    <!-- End Fact List -->
</div>
