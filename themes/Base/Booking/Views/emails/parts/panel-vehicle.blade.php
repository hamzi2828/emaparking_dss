<div class="b-panel">
    <div class="b-panel-title">{{__('Vehicle Detail')}}</div>
    <div class="b-table-wrap">
        <div class="b-table b-table-div">
            <div class="info-first-name b-tr">
                <div class="label">{{__('Registration')}}</div>
                <div class="val">{{$booking->vehicle_registration}}</div>
            </div>
            <div class="info-last-name b-tr" style="clear: both">
                <div class="label">{{__('Manufacture')}}</div>
                <div class="val">{{$booking->vehicle_manufacture}}</div>
            </div>
            <div class="info-email b-tr">
                <div class="label">{{__('Model')}}</div>
                <div class="val">{{$booking->vehicle_model}}</div>
            </div>
            <div class="info-phone b-tr">
                <div class="label">{{__('Color')}}</div>
                <div class="val">{{$booking->vehicle_color}}</div>
            </div>

        </div>
    </div>
</div>
