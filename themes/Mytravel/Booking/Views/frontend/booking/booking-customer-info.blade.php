<div class="pt-4 pb-5 px-5 border-bottom booking-review">
<!--    <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
        {{ __("Your Information") }}
    </h5>-->
    <!-- Fact List -->
    <ul class="list-unstyled font-size-1 mb-0 font-size-16">




        <li class="info-first-name d-flex justify-content-between py-2">
            <div class="label">{{__('Name: ')}}</div>
            <div class="val">{{$booking->first_name}} {{$booking->last_name}}</div>
        </li>
        <li class="info-email d-flex justify-content-between py-2">
            <div class="label">{{__('Email: ')}}</div>
            <div class="val">&nbsp;{{$booking->email}}</div>
        </li>
        <li class="info-phone d-flex justify-content-between py-2">
            <div class="label">{{__('Phone:')}}</div>
            <div class="val">&nbsp;{{$booking->phone}}</div>
        </li>

        <li class="info-city d-flex justify-content-between py-2">
            <div class="label">{{__('City')}}</div>
            <div class="val">{{$booking->city}}</div>
        </li>

        <li class="info-country d-flex justify-content-between py-2">
            <div class="label">{{__('Country')}}</div>
            <div class="val">{{get_country_name($booking->country)}}</div>
        </li>

    </ul>
    <!-- End Fact List -->
</div>
