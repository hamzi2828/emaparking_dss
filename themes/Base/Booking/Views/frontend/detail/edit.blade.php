<form action="{{route('report.admin.booking.update')}}" method="POST" class="mx-auto">
    @csrf
    <h5>Booking Detail</h5>
    <input type="hidden" name="id" value="{{$booking->id}}">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="arrival">Arrival:</label>
                <input type="datetime-local" value="{{$booking->start_date}}" step="any" name="start_date" id="arrival" required class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="departure">Departure:</label>
                <input type="datetime-local" value="{{$booking->end_date}}" step="any" id="departure" name="end_date" required class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="reference">Reference No:</label>
                <input type="text" value="{{$booking->reference_no}}" id="reference" name="reference_no" required class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="booking_date">Booking Date:</label>
                <input type="datetime-local" value="{{$booking->created_at}}" step="any" id="booking_date" name="created_at" required class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="flight_no">Flight No:</label>
                <input type="text" value="{{$booking->flight_no}}" id="flight_no" name="flight_no" class="form-control"/>
            </div>
        </div>
    </div>
    <hr/>
    <h5>Vehicle Detail</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="vehicle_registration">Registration:</label>
                <input type="text" value="{{$booking->vehicle_registration}}" id="vehicle_registration" name="vehicle_registration" required class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="vehicle_manufacture">Manufacture:</label>
                <input type="text" value="{{$booking->vehicle_manufacture}}" id="vehicle_manufacture" name="vehicle_manufacture" required class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="vehicle_model">Model:</label>
                <input type="text" value="{{$booking->vehicle_model}}" id="vehicle_model" name="vehicle_model" required class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="vehicle_color">Color:</label>
                <input type="text" value="{{$booking->vehicle_color}}" id="vehicle_color" name="vehicle_color" required class="form-control"/>
            </div>
        </div>
    </div>
    <hr/>
    <h5>Payment Detail</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="product">Product:</label>
                <select class="form-control" required name="object_id" id="product">
                    <option selected value="" disabled>Select a product</option>
                    @foreach($spaces as $space)
                        <option @if($space->id == $booking->object_id) selected @endif value="{{$space->id}}">{{$space->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="customer">Customer:</label>
                <select class="form-control" required name="customer_id" id="customer">
                    <option selected value="" disabled>Select a customer</option>
                    @foreach($customers as $customer)
                        @if($customer->booking_agent==false)
                            @continue;
                        @endif
                        <option @if($customer->id == $booking->customer_id) selected @endif value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                    @if($booking->customer_id == null)
                        <option selected value="">EMA</option>
                    @elseif($booking->customer->booking_agent==false)
                        <option selected value="{{$booking->customer_id}}">EMA</option>
                    @else
                        <option value="">EMA</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" value="{{$booking->total}}" id="price" name="total" required class="form-control"/>
            </div>
        </div>
    </div>
    <hr/>
    <h5>Customer Detail</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="first_name">Firstname:</label>
                <input type="text" value="{{$booking->first_name}}" id="first_name" name="first_name" required class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="last_name">Lastname:</label>
                <input type="text" value="{{$booking->last_name}}" id="last_name" name="last_name" class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" value="{{$booking->phone}}" id="phone" name="phone" class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" value="{{$booking->email}}" id="email" name="email" class="form-control"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" value="{{$booking->address}}" id="address" name="address" class="form-control"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address2">Address Line 2:</label>
                <input type="text" value="{{$booking->address2}}" id="address2" name="address2" class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" value="{{$booking->city}}" id="city" name="city" class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" value="{{$booking->state}}" id="state" name="state" class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="zip">Zip:</label>
                <input type="text" value="{{$booking->zip_code}}" id="zip" name="zip_code" class="form-control"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" value="{{$booking->country}}" id="country" name="country" class="form-control"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="notes">Additional Notes:</label>
                <textarea id="notes" name="customer_notes" class="form-control" rows="3">{!! $booking->customer_notes !!}</textarea>
            </div>
        </div>
    </div>
    <hr/>
    <h5>Update Detail</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="reason">Reason:</label>
                <textarea id="reason" required name="reason" class="form-control" rows="1" placeholder="Please enter your reason for updating this booking"></textarea>
            </div>
        </div>
    </div>
    <hr/>
    <button class="btn btn-success" type="submit">Update</button>
</form>
