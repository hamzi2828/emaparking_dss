<div class="modal fade" id="modal-booking-cancel-{{$booking->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> @if($booking->isInCancellation()) {{__("Cancellation Status Booking")}} @else {{__("Cancel Booking")}}@endif: {{$booking->reference_no}}</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                @if(!empty($booking->cancellation_requests))
                    @foreach($booking->cancellation_requests as $cancel_request)
                        {!! $cancel_request->getStatusBadge() !!}
                        <p class="mt-2">Requested: {{getDateTimefomat($cancel_request->created_at)}}</p>
                        <p class="ml-2">Message: {{$cancel_request->user_message}}</p>
                        @if($cancel_request->admin_message !=null)
                            <p>Replied: {{getDateTimefomat($cancel_request->updated_at)}}</p>
                            <p class="ml-2">Message: {{$cancel_request->admin_message}}</p>
                        @endif
                        @if(auth()->user()->role()->first()->id==1 && $cancel_request->status == 'pending')
                            <form action="{{ route('user.booking.cancel.update')}}" class="needs-validation sfeedbacks_form mb-2" novalidate method="post">
                                @csrf
                                <div class="row mb-5 mb-lg-0">

                                    <div class="col-sm-12 mb-2">
                                        <div class="js-form-message">
                                            <div class="input-group">
                                                <textarea class="form-control" rows="6" cols="77" name="admin_message" placeholder="{{__("Please write reply message")}}" required data-msg="{{__('Cancellation reply message has at least 10 character')}}" data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                                <div class="invalid-feedback">{{__('Cancel reply has at least 10 character')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-center justify-content-lg-start">
                                        <button type="submit" name="action" value="rejected" class="btn rounded-xs  btn-danger text-white p-2 height-51 width-190 transition-3d-hover mr-2">{{__("Reject")}}</button>
                                        <button type="submit" id="submit" name="action" value="approved" class="btn rounded-xs  btn-primary text-white p-2 height-51 width-190 transition-3d-hover">{{__("Approve")}}</button>
                                        <input type="hidden" name="cancellation_id" value="{{$cancel_request->id}}">
                                    </div>
                                </div>

                            </form>

                        @endif
                        <div class="border-bottom mb-2"></div>
                    @endforeach
                @endif
                @if(!$booking->isInCancellation() && auth()->user()->role()->first()->id!=1 && !$booking->alreadyCancelled())
                    @if(Auth::id())
                        <h5 class="font-size-21 font-weight-bold text-dark mb-6">
                            {{__("Submit booking for cancellation")}}
                        </h5>
                        <div class="form-wrapper">

                            <form action="{{ route('user.booking.cancel')}}" class="needs-validation sfeedbacks_form" novalidate method="post">
                                @csrf
                                <div class="row mb-5 mb-lg-0">

                                    <div class="col-sm-12 mb-2">
                                        <div class="js-form-message">
                                            <div class="input-group">
                                                <textarea class="form-control" rows="6" cols="77" name="user_message" placeholder="{{__("Please write cancellation reason or feedback")}}" required data-msg="{{__('Cancellation reason has at least 10 character')}}" data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                                <div class="invalid-feedback">{{__('Cancel reason has at least 10 character')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-center justify-content-lg-start">
                                        <button type="submit" id="submit" name="submit" class="btn rounded-xs  btn-primary text-white p-2 height-51 width-190 transition-3d-hover">{{__("Submit Cancellation")}}</button>
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

