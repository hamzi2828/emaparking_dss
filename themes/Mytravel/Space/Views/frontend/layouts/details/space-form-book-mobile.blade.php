<div class="bravo-more-book-mobile p-2">
    <div class="d-flex align-items-center justify-content-between">
        <div class="left pl-2">
            <div class="g-price">
                <div class="prefix">
                    <span class="fr_text">{{__("from")}}</span>
                </div>
                <div class="price">
                    <small class="font-size-16 text-decoration-line-through text-danger">
                        {{$row->price_range_calculate_before_discount(Request::query('start'), Request::query('end')) }}
                    </small>
                    {{$row->price_range_calculate(Request::query('start'), Request::query('end')) }}
                </div>
            </div>

            @if(setting_item('space_enable_review'))
            <?php
            $reviewData = $row->getScoreReview();
            $score_total = $reviewData['score_total'];
            ?>
            <div class="service-review d-flex align-items-center tour-review-{{$score_total}}">
                <div class="list-star">
                    <ul class="booking-item-rating-stars">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                    </ul>
                    <div class="booking-item-rating-stars-active" style="width: {{  $score_total * 2 * 10 ?? 0  }}%">
                        <ul class="booking-item-rating-stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <span class="review">
                        @if($reviewData['total_review'] > 1)
                        {{ __(":number Reviews",["number"=>$reviewData['total_review'] ]) }}
                    @else
                        {{ __(":number Review",["number"=>$reviewData['total_review'] ]) }}
                    @endif
                    </span>
            </div>
            @endif
        </div>
        <div class="right w-100">
            <div class="d-flex justify-content-end">
                <a href="{{url()->previous()}}" class="btn btn-secondary d-none d-sm-block mr-2" style="padding: 8px 20px 6px;">
                    Modify search
                </a>
               @if($row->getBookingEnquiryType() === "book")
                   <a class="btn btn-primary bravo-button-book-mobile-btn">{{__("Book Now")}}</a>
               @else
                   <a class="btn btn-primary" data-toggle="modal" data-target="#enquiry_form_modal">{{__("Contact Now")}}</a>
               @endif

            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(".bravo-button-book-mobile-btn").click(function () {
            $('.form-book-now').click()
        });
    </script>
@endpush
