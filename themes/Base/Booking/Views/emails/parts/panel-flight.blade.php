<div class="b-panel">
    <div class="b-panel-title">{{__('Flight & Timing Details')}}</div>
    <div class="b-table-wrap">
        <div class="b-table b-table-div">
            <div class="info-first-name b-tr">
                <div class="label">{{__('Flight No')}}</div>
                <div class="val">{{$booking->flight_no}}</div>
            </div>
            <div class="info-last-name b-tr" style="clear: both">
                <div class="label">{{__('Arrival Time')}}</div>
                <div class="val">{{\Carbon\Carbon::parse($booking->start_date)->format('g:i A')}}</div>
            </div>
            <div class="info-email b-tr">
                <div class="label">{{__('Departure Time')}}</div>
                <div class="val">{{\Carbon\Carbon::parse($booking->end_date)->format('g:i A')}}</div>
            </div>

        </div>
    </div>
</div>
