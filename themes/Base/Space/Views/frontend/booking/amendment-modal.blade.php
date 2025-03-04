<div class="modal fade" id="modal-booking-amend-{{$booking->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> @if($booking->isInAmendment()) {{__("Amendment Status Booking")}} @else {{__("Amend Booking")}}@endif: {{$booking->reference_no}}</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                @if(!empty($booking->amendment_requests))
                    @foreach($booking->amendment_requests as $amend_request)
                        {!! $amend_request->getStatusBadge() !!}
                        <p class="mt-2">Requested: {{getDateTimefomat($amend_request->created_at)}}</p>
                        <div class="row">
                            @foreach($amend_request->data as $key => $field)

                                <div class="col-6 my-2">
                                    <h5 class="text-center border-bottom">{{formatFieldNames($key)}}</h5>
                                    <div class="row">

                                        <div class="col-6">
                                            <div>
                                                <label>Old:</label>
                                                <input type="text" class="form-control" disabled value="{{$field['old']}}">
                                            </div>


                                        </div>
                                        <div class="col-6">
                                            <div>
                                            <label>New:</label>
                                            <input type="text" class="form-control" disabled value="{{$field['new']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                          @endforeach
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <label>Reason:</label>
                                    <input type="text" class="form-control" disabled value="{{$amend_request->user_message}}">
                                </div>

                            </div>
                        </div>
                        @if($amend_request->admin_message !=null)
                            <p>Replied: {{getDateTimefomat($amend_request->updated_at)}}</p>
                            <p class="ml-2">Message: {{$amend_request->admin_message}}</p>
                        @endif
                        @if(auth()->user()->role()->first()->id==1 && $amend_request->status == 'pending')
                            <form action="{{ route('user.booking.amend.update')}}" class="needs-validation sfeedbacks_form mb-2" novalidate method="post">
                                @csrf
                                <div class="row mb-5 mb-lg-0 mt-2">

                                    <div class="col-sm-8 my-2">
                                        <div class="js-form-message">
                                            <label>Reply/Invoice Item:</label>
                                            <div class="input-group">
                                                <textarea class="form-control" rows="1" cols="77" name="admin_message" placeholder="{{__("Please write reply message/invoice item description")}}" required data-msg="{{__('Amendment reply message has at least 10 character')}}" data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                                <div class="invalid-feedback">{{__('Amend reply/invoice item has at least 10 character')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 my-2">
                                        <div class="js-form-message">
                                            <label>Price Change:</label>
                                            <div class="input-group">
                                                <input type="text" value="0" name="price" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-center justify-content-lg-start">
                                        <button type="submit" name="action" value="rejected" class="btn rounded-xs  btn-danger text-white p-2 height-51 width-190 transition-3d-hover mr-2">{{__("Reject")}}</button>
                                        <button type="submit" id="submit" name="action" value="approved" class="btn rounded-xs  btn-primary text-white p-2 height-51 width-190 transition-3d-hover">{{__("Approve")}}</button>
                                        <input type="hidden" name="amendment_id" value="{{$amend_request->id}}">
                                    </div>
                                </div>

                            </form>

                        @endif
                    @endforeach
                @endif
                @if(!$booking->isInAmendment() && auth()->user()->role()->first()->id!=1)
                    @if(Auth::id())

                        <div class="form-wrapper">

                            <form action="{{ route('user.booking.amend')}}" class="needs-validation sfeedbacks_form" novalidate method="post">
                                @csrf
                                <div class="row mb-5 mb-lg-0">

                                    <div class="col-sm-12 mb-2">
                                        <h5 class="text-center border-bottom">Personal Information</h5>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="js-form-message">
                                                    <label>Firstname:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="first_name" value="{{$booking->first_name}}" placeholder="{{__("First Name")}}" required data-msg="{{__('Firstname is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Firstname is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="js-form-message">
                                                    <label>Lastname:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="last_name" value="{{$booking->last_name}}" placeholder="{{__("Last Name")}}" required data-msg="{{__('Lastname is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Lastname is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="js-form-message">
                                                    <label>Email Address:</label>
                                                    <div class="input-group">
                                                        <input type="email" class="form-control" disabled value="{{$booking->email}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="js-form-message">
                                                    <label>Phone Number:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="phone" value="{{$booking->phone}}" placeholder="{{__("Phone Number")}}" required data-msg="{{__('Phone Number is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Phone Number is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 my-2">
                                        <h5 class="text-center border-bottom">Arrival Information</h5>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="js-form-message">
                                                    <label>Date:</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" name="arrival_date" @if($booking->collection_time != null) disabled @endif value="{{Carbon\Carbon::parse($booking->start_date)->toDateString()}}" placeholder="{{__("Arrival Date")}}" required data-msg="{{__('Amendment arrival date is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Arrival date is required')}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="js-form-message">
                                                    <label>Time:</label>
                                                    <div class="input-group">
                                                        <input type="time" class="form-control" name="arrival_time" @if($booking->collection_time != null) disabled @endif value="{{Carbon\Carbon::parse($booking->start_date)->toTimeString()}}" placeholder="{{__("Arrival Time")}}" required data-msg="{{__('Amendment arrival date is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Arrival time is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 my-2">
                                        <h5 class="text-center border-bottom">Departure Information</h5>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="js-form-message">
                                                    <label>Date:</label>

                                                    <div class="input-group">

                                                        <input type="date" class="form-control" name="departure_date" value="{{Carbon\Carbon::parse($booking->end_date)->toDateString()}}" placeholder="{{__("Departure Date")}}" required data-msg="{{__('Amendment arrival date is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Departure date is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="js-form-message">
                                                    <label>Time:</label>

                                                    <div class="input-group">
                                                        <input type="time" class="form-control" name="departure_time" value="{{Carbon\Carbon::parse($booking->end_date)->toTimeString()}}" placeholder="{{__("Departure Time")}}" required data-msg="{{__('Amendment arrival date is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Departure time is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 my-2">
                                        <h5 class="text-center border-bottom">Vehicle Information</h5>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="js-form-message">
                                                    <label>Manufacture:</label>

                                                    <div class="input-group">

                                                        <input type="text" class="form-control" name="vehicle_manufacture" value="{{$booking->vehicle_manufacture}}" placeholder="{{__("Vehicle Manufacture")}}" required data-msg="{{__('Vehicle Manufacture is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Vehicle Manufacture is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="js-form-message">
                                                    <label>Model:</label>

                                                    <div class="input-group">

                                                        <input type="text" class="form-control" name="vehicle_model" value="{{$booking->vehicle_model}}" placeholder="{{__("Vehicle Model")}}" required data-msg="{{__('Vehicle Model is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Vehicle Model is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="js-form-message">
                                                    <label>Registration:</label>

                                                    <div class="input-group">

                                                        <input type="text" class="form-control" name="vehicle_registration" value="{{$booking->vehicle_registration}}" placeholder="{{__("Vehicle Registration")}}" required data-msg="{{__('Vehicle Registration is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Vehicle Registration is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="js-form-message">
                                                    <label>Color:</label>

                                                    <div class="input-group">

                                                        <input type="text" class="form-control" name="vehicle_color" value="{{$booking->vehicle_color}}" placeholder="{{__("Vehicle Color")}}" required data-msg="{{__('Vehicle Color is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Vehicle Color is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 my-2">
                                        <h5 class="text-center border-bottom">Other Information</h5>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="js-form-message">
                                                    <label>Flight No:</label>

                                                    <div class="input-group">

                                                        <input type="text" class="form-control" name="flight_no" value="{{$booking->flight_no}}" placeholder="{{__("Flight No")}}" required data-msg="{{__('Flight No is required')}}" data-error-class="u-has-error" data-success-class="u-has-success">
                                                        <div class="invalid-feedback">{{__('Flight No is required')}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="js-form-message">
                                                    <label>Amendment Reason:</label>

                                                    <div class="input-group">
                                                        <textarea class="form-control" rows="1" cols="77" name="user_message" placeholder="{{__("Please write an amendment reason")}}" required data-msg="{{__('Amendment reason has at least 10 character')}}" data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                                        <div class="invalid-feedback">{{__('Amendment reason has at least 10 character')}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-center justify-content-lg-start">
                                        <button type="submit" id="submit" name="submit" class="btn rounded-xs  btn-primary text-white p-2 height-51 width-190 transition-3d-hover">{{__("Submit Amendment")}}</button>
                                        <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                    </div>
                                </div>

                            </form>
                        </div>
                    @endif
                @endif
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <span class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">{{__("Close")}}</span>
            </div>
        </div>
    </div>
</div>

