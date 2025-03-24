<div class="pt-4 pb-5 px-5 border-bottom booking-review">
    <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
        {{ __("Vehicle Detail") }}
    </h5>

    <ul class="list-unstyled font-size-1 mb-0 font-size-16">




        <li class="info-first-name d-flex justify-content-between py-2">
            <div class="label">{{__('Registration: ')}}</div>
            <div class="val">{{$booking->vehicle_registration}}</div>
        </li>
        <li class="info-email d-flex justify-content-between py-2">
            <div class="label">{{__('Manufacture: ')}}</div>
            <div class="val">&nbsp;{{$booking->vehicle_manufacture}}</div>
        </li>
        <li class="info-phone d-flex justify-content-between py-2">
            <div class="label">{{__('Model:')}}</div>
            <div class="val">&nbsp;{{$booking->vehicle_model}}</div>
        </li>
        <li class="info-phone d-flex justify-content-between py-2">
            <div class="label">{{__('Color:')}}</div>
            <div class="val">&nbsp;{{$booking->vehicle_color}}</div>
        </li>
    </ul>
    <!-- End Fact List -->
</div>
