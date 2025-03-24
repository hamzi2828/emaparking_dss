@extends('layouts.userDashboard.app')
@section('content')
    @php $lang_local = app()->getLocale() @endphp
    @include('admin.message')

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Index-->
            <div class="card ">
                <div class="card-header border-0 pt-5 pb-0">
                    <!--begin::Card title-->
                    <h3 class="card-title fw-bolder text-gray-800 fs-2"></h3>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <div class="my-1">
                            <!--begin::Select-->
                            <select class="form-select fw-bold w-125px statusoption" data-control="select2" data-placeholder="Status" data-hide-search="true">
                                <option value="1" selected="selected">Status</option>
                                <option value="2">Unpaid</option>
                                <option value="3">In Progress</option>
                                <option value="3">Completed</option>
                                <option value="3">Cancelled</option>
                            </select>

                            <!--end::Select-->
                        </div>
                    </div>
                    <!--end::Card toolbar-->
                </div>								<!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xxl-12">
                            <!--begin::Table Widget 1-->
                            <table class="table table-row-dashed table-row-gray-300 gy-7 align-items-center">
                                <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>Date</th>
                                    <th>Arrival</th>
                                    <th>Departure</th>
                                    <th>Pricing</th>
                                    <th>Status</th>
                                    <th>Directions</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bookings as $booking)
                                <tr>

                                    <td>{{$booking->created_at->format('d M Y')}}</td>
                                    <td>{{$booking->start_date}}</td>
                                    <td>{{$booking->end_date}}</td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-start align-items-start">
                                            <span class="mb-2">
                                                <b class="badge badge-dark">Total: £{{format_money($booking->total)}}</b>
                                            </span>

                                            <span class="mb-2">
                                                <b class="badge badge-danger">Due: £{{format_money($booking->total - $booking->paid)}}</b>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="{{$booking->status}}">{{$booking->statusName}}</td>
                                    <td>
                                        @if($service = $booking->service)
                                            @php
                                                $translation = $service->translate();
                                            @endphp
                                            <a target="_blank" href="{{$service->getDetailUrl()}}">
                                                {{$translation->title}}
                                            </a>
                                        @else
                                            {{__("[Product Deleted]")}}
                                        @endif
                                    </td>

                                    <td>
                                        @if($booking->status!='unpaid' && $booking->status!='cancelled' && \Carbon\Carbon::parse($booking->end_date)->setTime(0,0)->lte(\Carbon\Carbon::now()->setTime(0,0)))
                                            <a title="Review booking" class="btn btn-icon btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modal-booking-review-{{$booking->id}}">
                                                <i class="fa fa-star fs-2"></i>
                                            </a>
                                            @include ($service->checkout_booking_detail_review_modal_file ?? '')
                                        @endif
                                        @if($service = $booking->service)
                                            <a title="Booking details" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="bottom" href="#" class="btn btn-icon btn-sm btn-primary"  data-bs-toggle="modal" data-bs-target="#modal-booking-{{$booking->id}}"><i class="fas fa-info-circle fs-2"></i></a>
                                            <div class="modal fade" id="modal-booking-{{$booking->id}}" tabindex="-1" aria-labelledby="modalLabel{{$booking->id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="modalLabel{{$booking->id}}">{{__("Booking ID")}}: #{{$booking->id}}</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                            <div class="tab-content" id="myTabContent{{$booking->id}}">
                                                                <div class="tab-pane fade show active" id="booking-detail-{{$booking->id}}" role="tabpanel" aria-labelledby="booking-detail-tab-{{$booking->id}}"><br>

                                                                    <div class="more-booking-review">
                                                                        @include ('Booking::frontend/booking/booking-info-user')
                                                                        <h3 class="px-5 mt-3">Pricing Details</h3>
                                                                        <ul class="review-list">
                                                                            @php
                                                                                $price_item = $booking->total_before_extra_price;
                                                                            @endphp
                                                                            @if(!empty($price_item))
                                                                                <li>
                                                                                    <div class="label">{{__('Rental price')}}
                                                                                    </div>
                                                                                    <div class="val">
                                                                                        {{format_money( $price_item)}}
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                            @php $extra_price = $booking->getJsonMeta('extra_price') @endphp
                                                                            @if(!empty($extra_price))
                                                                                <li>
                                                                                    <div class="label-title"><strong>{{__("Extra Prices:")}}</strong></div>
                                                                                </li>
                                                                                <li class="no-flex">
                                                                                    <ul>
                                                                                        @foreach($extra_price as $type)
                                                                                            <li>
                                                                                                <div class="label">{{$type['name_'.$lang_local] ?? $type['name']}}:</div>
                                                                                                <div class="val">
                                                                                                    {{format_money($type['total'] ?? 0)}}
                                                                                                </div>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </li>
                                                                            @endif
                                                                            @php
                                                                                $list_all_fee = [];
                                                                                if(!empty($booking->buyer_fees)){
                                                                                    $buyer_fees = json_decode($booking->buyer_fees , true);
                                                                                    $list_all_fee = $buyer_fees;
                                                                                }
                                                                                if(!empty($vendor_service_fee = $booking->vendor_service_fee)){
                                                                                    $list_all_fee = array_merge($list_all_fee , $vendor_service_fee);
                                                                                }
                                                                            @endphp
                                                                            @if(!empty($list_all_fee))
                                                                                @foreach ($list_all_fee as $item)
                                                                                    @php
                                                                                        $fee_price = $item['price'];
                                                                                        if(!empty($item['unit']) and $item['unit'] == "percent"){
                                                                                            $fee_price = ( $booking->total_before_fees / 100 ) * $item['price'];
                                                                                        }
                                                                                    @endphp
                                                                                    <li>
                                                                                        <div class="label">
                                                                                            {{$item['name_'.$lang_local] ?? $item['name']}}
                                                                                            <i class="icofont-info-circle" data-toggle="tooltip" data-placement="top" title="{{ $item['desc_'.$lang_local] ?? $item['desc'] }}"></i>
                                                                                            @if(!empty($item['per_person']) and $item['per_person'] == "on")
                                                                                                : {{$booking->total_guests}} * {{format_money( $fee_price )}}
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="val">
                                                                                            @if(!empty($item['per_person']) and $item['per_person'] == "on")
                                                                                                {{ format_money( $fee_price * $booking->total_guests ) }}
                                                                                            @else
                                                                                                {{ format_money( $fee_price ) }}
                                                                                            @endif
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif
                                                                            @includeIf('Coupon::frontend/booking/checkout-coupon')
                                                                            <li class="final-total d-block">
                                                                                <div class="d-flex justify-content-between">
                                                                                    <div class="label">{{__("Total:")}}</div>
                                                                                    <div class="val">{{format_money($booking->total)}}</div>
                                                                                </div>
                                                                                @if($booking->status !='draft')
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <div class="label">{{__("Paid:")}}</div>
                                                                                        <div class="val">{{format_money($booking->paid)}}</div>
                                                                                    </div>
                                                                                    @if($booking->paid < $booking->total )
                                                                                        <div class="d-flex justify-content-between">
                                                                                            <div class="label">{{__("Remain:")}}</div>
                                                                                            <div class="val">{{format_money($booking->total - $booking->paid)}}</div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </li>
                                                                            @include ('Booking::frontend/booking/checkout-deposit-amount')
                                                                        </ul>
                                                                        @include ('Booking::frontend/booking/booking-customer-info-user')
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__("Close")}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <a title="Invoice" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="bottom" href="{{route('user.booking.invoice',['code'=>$booking->code])}}" class="btn btn-icon btn-sm btn-success"><i class="fas fa-file-invoice fs-2"></i></a>
                                        @if(!$booking->isInCancellation() && $booking->status != 'cancelled' && $booking->return_time ==null)
                                            <a title="Booking amendments"  data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="bottom" href="#" data-bs-toggle="modal" data-bs-target="#modal-booking-amend-{{$booking->id}}" class="btn btn-icon btn-sm btn-info"><i class="fas fa-plus-circle fs-2"></i></a>
                                            @include ($service->checkout_booking_detail_amendment_modal_file ?? '')
                                        @endif
                                        @if($booking->total > $booking->paid && $booking->gateway == 'stripe')
                                            <form class="d-inline" action="{{route('booking.payNow')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$booking->id}}">
                                                <button type="submit" title="Pay Now" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="bottom"  href="#" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-wallet fs-2"></i></button>
                                            </form>

                                        @endif
                                        @if(($booking->collection_time==null && !$booking->isInCancellation()) || !empty($booking->cancellation_requests))
                                            <a title="Cancellation" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="bottom" href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-booking-cancel-{{$booking->id}}"><i class="fas fa-times-circle fs-2"></i></a>
                                            @include ($service->checkout_booking_detail_cancel_modal_file ?? '')
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <!--end::Table Widget 1-->
                        </div>
                        <!--end::Col-->

                    </div>
                    <!--end::Row-->

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Index-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@section('pageTitle','My Bookings')
