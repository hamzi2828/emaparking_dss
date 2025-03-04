<tr>
<!--    <td class="booking-history-type">
        @if($service = $booking->service)
            <i class="{{$service->getServiceIconFeatured()}}"></i>
        @endif
        <small>{{$booking->object_model}}</small>
    </td>-->
    <td>
        @if($service = $booking->service)
            @php
                $translation = $service->translate();
            @endphp
            <a target="_blank" href="{{$service->getDetailUrl()}}">
                {!! clean($translation->title) !!}
            </a>
        @else
            {{__("[Deleted]")}}
        @endif
    </td>
    <td class="a-hidden">{{display_date($booking->created_at)}}</td>
    <td class="a-hidden">
        {{__("Start date")}} : {{display_date($booking->start_date)}} <br>
        {{__("End date")}} : {{display_date($booking->end_date)}} <br>
        {{__("Duration")}} :
        @if($booking->getMeta("booking_type") == "by_day")
            @if($booking->duration_days <= 1)
                {{__(':count day',['count'=>$booking->duration_days])}}
            @else
                {{__(':count days',['count'=>$booking->duration_days])}}
            @endif
        @endif
        @if($booking->getMeta("booking_type") == "by_night")
            @if($booking->duration_nights <= 1)
                {{__(':count night',['count'=>$booking->duration_nights])}}
            @else
                {{__(':count nights',['count'=>$booking->duration_nights])}}
            @endif
        @endif
    </td>
    <td>{{format_money($booking->total)}}</td>
    <td>{{format_money($booking->paid)}}</td>
    <td>{{format_money($booking->total - $booking->paid)}}</td>
    <td class="{{$booking->status}} a-hidden">{{$booking->statusName}}</td>
    <td width="3%">
        @if($service = $booking->service)
            <a class="btn btn-xs btn-primary btn-info-booking" data-toggle="modal" data-target="#modal-booking-{{$booking->id}}">
                <i class="fa fa-info-circle"></i>{{__("Details")}}
            </a>
            @include ($service->checkout_booking_detail_modal_file ?? '')
        @endif
        <a href="{{route('user.booking.invoice',['code'=>$booking->code])}}" class="btn btn-xs btn-primary btn-info-booking open-new-window mt-1" onclick="window.open(this.href); return false;">
            <i class="fa fa-print"></i>{{__("Invoice")}}
        </a>
        @if(!$booking->isInCancellation() && $booking->status != 'cancelled' && $booking->return_time ==null)
            <a class="btn btn-xs btn-primary btn-info-booking mt-1" data-toggle="modal" data-target="#modal-booking-amend-{{$booking->id}}">
                <i class="fa fa-plus-circle"></i>{{__("Amendment")}}
            </a>
            @include ($service->checkout_booking_detail_amendment_modal_file ?? '')
        @endif
        @if($booking->total > $booking->paid && $booking->gateway == 'stripe')
                <form action="{{route('booking.payNow')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$booking->id}}">
                    <button type="submit" class="btn btn-xs btn-primary btn-info-booking mt-1"><i class="fa fa-money"></i> Pay</button>
                </form>
        @endif
        @if($booking->status!='unpaid' && $booking->status!='cancelled' && \Carbon\Carbon::parse($booking->end_date)->setTime(0,0)->lte(\Carbon\Carbon::now()->setTime(0,0)))
            <a class="btn btn-xs btn-primary btn-info-booking mt-1" data-toggle="modal" data-target="#modal-booking-review-{{$booking->id}}">
                <i class="fa fa-star"></i>{{__("Review")}}
            </a>
            @include ($service->checkout_booking_detail_review_modal_file ?? '')
        @endif
        @if($booking->collection_time==null && !$booking->isInCancellation())
            <a class="btn btn-xs btn-primary btn-info-booking mt-1" data-toggle="modal" data-target="#modal-booking-cancel-{{$booking->id}}">
                <i class="fa fa-close"></i>{{__("Cancellation")}}
            </a>
            @include ($service->checkout_booking_detail_cancel_modal_file ?? '')
        @elseif(!empty($booking->cancellation_requests))
            <a class="btn btn-xs btn-primary btn-info-booking mt-1" data-toggle="modal" data-target="#modal-booking-cancel-{{$booking->id}}">
                    <i class="fa fa-close"></i>{{__("Cancellation")}}
            </a>
            @include ($service->checkout_booking_detail_cancel_modal_file ?? '')
        @endif


    </td>
</tr>
