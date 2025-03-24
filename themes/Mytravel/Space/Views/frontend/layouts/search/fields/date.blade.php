<!--<div class="item">

&lt;!&ndash;    <span class="d-block text-gray-1 text-left font-weight-normal">
        Please select your arrival & departure dates
    </span>
    <div class="border-bottom border-width-2 border-color-1 form-content">
        <div class="u-datepicker overflow-hidden input-group py-2 flex-nowrap form-date-search">
            <div class="input-group-prepend">
                <span class="d-flex align-items-center mr-2 font-size-21">
                    <i class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                </span>
            </div>
            <div class="date-wrapper height-40 font-size-16 ml-1 shadow-none font-weight-bold form-control hero-form bg-transparent border-0 flatpickr-input p-0">
                <div class="render check-in-render">{{Request::query('start',display_date(strtotime("+1 day")))}}</div>
                <span> - </span>
                <div class="render check-out-render">{{Request::query('end',display_date(strtotime("+7 day")))}}</div>
            </div>
            <input type="hidden" class="check-in-input" value="{{Request::query('start',display_date(strtotime("+1 day")))}}" name="start">
            <input type="hidden" class="check-out-input" value="{{Request::query('end',display_date(strtotime("+7 day")))}}" name="end">
            <input type="text" class="check-in-out" name="date" value="{{Request::query('date',date("Y-m-d")." - ".date("Y-m-d",strtotime("+7 day")))}}">
        </div>
    </div>&ndash;&gt;
</div>-->
<div class="row">
    <div class="col-lg-3 col-6">
            <span class="d-block text-gray-1 text-left font-weight-normal">
                Arrival Date
            </span>
        <div class="border-bottom border-width-2 border-color-1 form-content">
            <div class="u-datepicker overflow-hidden input-group py-2 flex-nowrap form-date-search is_single_picker">
                <div class="input-group-prepend">
                <span class="d-flex align-items-center mr-2 font-size-21">
                    <i class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                </span>
                </div>
                <div class="date-wrapper height-40 font-size-16 ml-1 shadow-none font-weight-bold form-control hero-form bg-transparent border-0 flatpickr-input p-0">
                    <div class="render check-in-render">{{Request::query('start', 'Arrival Date')}}</div>
                </div>
                <input type="hidden" class="check-in-input" value="{{Request::query('start')}}" name="start">
                <input type="text" class="check-in-out" name="date1" value="{{Request::query('date1')}}">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
            <span class="d-block text-gray-1 text-left font-weight-normal">
                Arrival Time
            </span>
        <div class="border-bottom border-width-2 border-color-1 form-content mt-2">
            <div class="u-datepicker overflow-hidden input-group py-2 flex-nowrap">
                <div class="input-group-prepend">
                <span class="d-flex align-items-center mr-2 font-size-21">

                    <i class="flaticon-aeroplane text-primary font-weight-semi-bold"></i>
                </span>
                </div>
                <input style="border: none;" type="time" name="arrival_time" value="{{Request::query('arrival_time')}}">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
            <span class="d-block text-gray-1 text-left font-weight-normal">
                Return Date
            </span>
        <div class="border-bottom border-width-2 border-color-1 form-content">
            <div class="u-datepicker overflow-hidden input-group py-2 flex-nowrap form-date-search is_single_picker">
                <div class="input-group-prepend">
                <span class="d-flex align-items-center mr-2 font-size-21">
                    <i class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                </span>
                </div>
                <div class="date-wrapper height-40 font-size-16 ml-1 shadow-none font-weight-bold form-control hero-form bg-transparent border-0 flatpickr-input p-0">
                    <div class="render check-out-render">{{Request::query('end', "Return Date")}}</div>
                </div>
                <input type="hidden" class="check-out-input" value="{{Request::query('start',)}}" name="end">
                <input type="text" class="check-in-out" name="date2" value="{{Request::query('date2')}}">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
            <span class="d-block text-gray-1 text-left font-weight-normal">
                Return Time
            </span>
        <div class="border-bottom border-width-2 border-color-1 form-content mt-2">
            <div class="u-datepicker overflow-hidden input-group py-2 flex-nowrap">
                <div class="input-group-prepend">
                <span class="d-flex align-items-center mr-2 font-size-21">

                    <i class="flaticon-aeroplane text-primary font-weight-semi-bold"></i>
                </span>
                </div>
                <input style="border: none;" type="time" name="departure_time" value="{{Request::query('departure_time')}}">
            </div>
        </div>
    </div>
</div>
