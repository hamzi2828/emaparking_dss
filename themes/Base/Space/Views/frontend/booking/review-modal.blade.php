<div class="modal fade" id="modal-booking-review-{{$booking->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{__("Review Booking ID")}}: #{{$booking->id}}</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                @if(Auth::id())
                    <h5 class="font-size-21 font-weight-bold text-dark mb-6">
                        {{__("Write a review")}}
                    </h5>
                    <div class="form-wrapper">

                        <form action="{{ route('review.store')}}" class="needs-validation sfeedbacks_form" novalidate method="post">
                            @csrf
                            <div class="row mb-5 mb-lg-0">

                                <div class="col-sm-12">
                                    <div class="row">
                                        @if($tour_review_stats = setting_item($booking->service->type."_review_stats"))
                                            @php $tour_review_stats = json_decode($tour_review_stats) @endphp
                                            @foreach($tour_review_stats as $item)
                                                <div class="col-md-4 mb-6">
                                                    <h6 class="font-weight-bold text-dark mb-1">
                                                        {{$item->title}}
                                                    </h6>
                                                    <input class="review_stats" type="hidden" name="review_stats[{{$item->title}}]">
                                                    <span class="font-size-20 letter-spacing-3 sspd_review">
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                        <small class="fa fa-star font-weight-normal"></small>
                                                    </span>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-4 mb-6">
                                                <h6 class="font-weight-bold text-dark mb-1">
                                                    {{__("Review rate")}}
                                                </h6>
                                                <input class="review_stats" type="hidden" name="review_rate">
                                                <span class="font-size-20 letter-spacing-3 sspd_review">
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                    <small class="fa fa-star font-weight-normal"></small>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 my-2">
                                    <div class="js-form-message">
                                        <input type="text" class="form-control" name="review_title" placeholder="{{__("Title")}}" required data-error-class="u-has-error" data-msg="{{__('Review title is required')}}" data-success-class="u-has-success">
                                        <div class="invalid-feedback">{{__('Review title is required')}}</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <div class="js-form-message">
                                        <div class="input-group">
                                            <textarea class="form-control" rows="6" cols="77" name="review_content" placeholder="{{__("Review content")}}" required data-msg="{{__('Review content has at least 10 character')}}" data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                            <div class="invalid-feedback">{{__('Review content has at least 10 character')}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center justify-content-lg-start">
                                    <button type="submit" id="submit" name="submit" class="btn rounded-xs  btn-primary text-white p-2 height-51 width-190 transition-3d-hover">{{__("Submit Review")}}</button>
                                    <input type="hidden" name="review_service_id" value="{{$booking->service->id}}">
                                    <input type="hidden" name="review_service_type" value="{{ $booking->service->type }}">
                                </div>
                            </div>

                        </form>
                    </div>
                    <style>
                        .sspd_review .fa.selected {
                            color: #5191fa;
                        }
                    </style>
                @endif
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <span class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">{{__("Close")}}</span>
            </div>
        </div>
    </div>
</div>

