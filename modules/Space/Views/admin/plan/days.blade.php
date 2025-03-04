<div class="row">
    @for($i = 0; $i<31; $i++)
        <div class="col-md-4">
            <div class="form-group">
                <label>{{"Day ".($i+1)}}</label>
                <input type="number" value="{{$row['days'] != null ? $row['days'][$i] : 0}}" placeholder="{{__("Price for Day".($i+1) )}}" name="days[{{$i}}]" class="form-control">
                <label>{{" Partner Day ".($i+1)}}</label>
                <input type="number" value="{{$row['partner_days'] != null ? $row['partner_days'][$i] : 0}}" placeholder="{{__("Partner Price for Day".($i+1) )}}" name="partner_days[{{$i}}]" class="form-control">

            </div>
        </div>
    @endfor
    <div class="col-md-8">
        <div class="form-group">
            <label>{{"Per day after 31 days:"}}</label>
            <input type="number" value="{{$row['days'] != null ? (isset($row['days'][31]) ? $row['days'][31] : 0) : 0}}" placeholder="{{__("Price per day" )}}" name="days[31]" class="form-control">
            <label>{{"Partner Per day after 31 days:"}}</label>
            <input type="number" value="{{$row['partner_days'] != null ? (isset($row['partner_days'][31]) ? $row['partner_days'][31] : 0) : 0}}" placeholder="{{__("Price per day" )}}" name="days[31]" class="form-control">

        </div>
    </div>

</div>

