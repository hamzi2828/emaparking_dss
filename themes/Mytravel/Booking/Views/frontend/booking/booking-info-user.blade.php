<div class="px-5 booking-review">

    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
        <h3>Booking Details</h3>
        <div class="row">

            <div class="col-md-4">
                <li class="info-first-name d-flex justify-content-start py-2">
                    <div class="label">{{__('Booking Status: ')}}</div>
                    <div class="val">&nbsp;{{$booking->statusName}}</div>
                </li>
            </div>
            <div class="col-md-4">
                <li class="info-city d-flex justify-content-start py-2">
                    <div class="label">{{__('Booking Date:')}}</div>
                    <div class="val">&nbsp;{{$booking->created_at}}</div>
                </li>
            </div>
            <div class="col-md-4">
                <li class="info-country d-flex justify-content-start py-2">
                    <div class="label">{{__('Reference No:')}}</div>
                    <div class="val">&nbsp;{{$booking->reference_no}}</div>
                </li>
            </div>

        </div>

    </ul>
    <!-- End Fact List -->
</div>
