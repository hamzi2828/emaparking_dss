@extends ('admin.layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('All Bookings')}}</h1>
            @if(!empty($booking_manage_others))
                <div>
                    <form action="{{route('report.admin.booking.print')}}" method="POST" class="d-inline-block">
                        @csrf
                        <input type="hidden" name="bookings" value="{{json_encode($all)}}">
                        <button type="submit" class="btn btn-success text-white">Download Key logs</button>
                    </form>

                    <a class="btn btn-warning text-white" href="{{route('report.admin.booking.import')}}">Import</a>
                    <form action="{{route('report.admin.booking.export')}}" method="POST" class="d-inline-block">
                        @csrf
                        <input type="hidden" name="bookings" value="{{json_encode($all)}}">
                        <button type="submit" class="btn btn-secondary text-white">Export</button>
                    </form>
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-addBooking">Add
                        Booking</a>
                </div>
            @endif
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between">
            <div class="col-left">
                @if(!empty($booking_update))
                    <form method="post" action="{{route('report.admin.booking.bulkEdit')}}"
                          class="filter-form filter-form-left d-flex justify-content-start">
                        @csrf
                        <select name="action" class="form-control">
                            <option value="">{{__("-- Bulk Actions --")}}</option>
                            @if(!empty($statues))
                                @foreach($statues as $status)
                                    <option
                                        value="{{$status}}">{{__('Mark as: :name',['name'=>booking_status_to_text($status)])}}</option>
                                @endforeach
                            @endif
                            <option value="delete">{{__("DELETE booking")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}"
                                class="btn-info btn btn-icon dungdt-apply-form-btn"
                                type="button">{{__('Apply')}}</button>
                    </form>
                @endif

            </div>
            <div class="col-left">
                <form method="get" action="" class="filter-form filter-form-right d-flex justify-content-end">
                    @csrf
                    @if(!empty($booking_manage_others))
                            <?php
                            /*$user = !empty(Request()->vendor_id) ? App\User::find(Request()->vendor_id) : false;
                            \App\Helpers\AdminForm::select2('vendor_id', [
                                'configs' => [
                                    'ajax'        => [
                                        'url'      => route('user.admin.getForSelect2'),
                                        'dataType' => 'json'
                                    ],
                                    'allowClear'  => true,
                                    'placeholder' => __('-- Vendor --')
                                ]
                            ], !empty($user->id) ? [
                                $user->id,
                                $user->name_or_email . ' (#' . $user->id . ')'
                            ] : false)*/
                            ?>

                    @endif

                    <div class="mr-2">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Arrival Date</span>
                            </div>
                            <input type="text" value="{{ Request()->arrival }}" name="arrival"
                                   class="form-control ml-0 has-daterangepicker">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Return Date</span>
                            </div>
                            <input type="text" value="{{ Request()->departure }}" name="departure"
                                   class="form-control ml-0 has-daterangepicker">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Booking Date</span>
                            </div>
                            <input type="text" value="{{ Request()->booking_date }}" name="booking_date"
                                   class="form-control ml-0 has-daterangepicker">
                        </div>
                    </div>
                    <div class="mr-2">
                        <select name="sort" class="form-control pb-2 mb-2">
                            <option value="">{{__("-- Sort --")}}</option>
                            <option @if(Request()->sort == 'arrival_asc') selected @endif value="arrival_asc">Arrival
                                Date (Ascending)
                            </option>
                            <option @if(Request()->sort == 'arrival_desc') selected @endif value="arrival_desc">Arrival
                                Date (Descending)
                            </option>
                            <option @if(Request()->sort == 'return_asc') selected @endif value="return_asc">Return Date
                                (Ascending)
                            </option>
                            <option @if(Request()->sort == 'return_desc') selected @endif value="return_desc">Return
                                Date (Descending)
                            </option>
                        </select>
                        <input type="text" name="make" value="{{ Request()->make }}"
                               placeholder="{{__('by vehicle make')}}" class="form-control ml-0 pb-2 mb-2">
<!--                        <input type="text" name="model" value="{{ Request()->model }}"
                               placeholder="{{__('by vehicle model #')}}" class="form-control ml-0 pb-2">-->
                        <select name="supplier" class="form-control py-2 ml-0">
                            <option value="">{{__("-- Supplier --")}}</option>
                            @if(@$customers)
                            @foreach(@$customers as $customer)
                                @if($customer->booking_agent==false)
                                    @continue;
                                @endif
                                <option @if(Request()->supplier == $customer->id) selected @endif value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                            @endif
                            <option @if(Request()->supplier == 'ema') selected @endif value="ema">EMA</option>
                        </select>
                    </div>
                    <div class="mr-2">
                        <input type="text" name="s" value="{{ Request()->s }}"
                               placeholder="{{__('Search by name or ID')}}" class="form-control mb-2 ml-0 pb-2">
                        <input type="text" name="reference" value="{{ Request()->reference }}"
                               placeholder="{{__('by reference #')}}" class="form-control ml-0 mb-2 pb-2">
                        <input type="text" name="registration" value="{{ Request()->registration }}"
                               placeholder="{{__('by vehicle registration #')}}" class="form-control ml-0 pb-2">
                    </div>
                    <div>
                        <button class="btn-info btn btn-icon" type="submit">{{__('Filter')}}</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel booking-history-manager">
            <div class="panel-title">{{__('Bookings')}}</div>
            <div class="panel-body">
                <div class="bravo-form-item table-responsive overflow-lg-visible min-height-sm-300">
                    <table class="table table-hover bravo-list-item">
                        <thead>
                        <tr>
                            <th width="80px"><input type="checkbox" class="check-all"></th>
                            <th>Domain</th>
                            <th>Source</th>
                            <th>{{__('Service')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Vehicle')}}</th>
                            <th>{{__('Agent')}}</th>

                            <!--                            <th>{{__('Payment Information')}}</th>-->

                            <!--                            <th width="80px">{{__('Status')}}</th>-->
                            <!--                            <th width="150px">{{__('Payment Method')}}</th>-->
                            <th width="120px">{{__('Arrival')}}</th>
                            <th width="120px">{{__('Return')}}</th>
                            <th width="80px">{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            @php  $booking = $row; 
                                $bookingSourceArray =explode('-',$booking->booking_source);

                            @endphp
                            <tr>
                                <td><input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">
                                    #{{$row->id}}<br>
                                    <span class="ml-4"> {{ucfirst($row->statusName)}}</span>

                                </td>
                                <td>{{@$bookingSourceArray[0]}}</td>
                                <td style="color: red;text-transform: uppercase;">{{@$bookingSourceArray[1]}}</td>
                                <td>
                                    @if($service = $row->service)
                                        <a href="{{$service->getDetailUrl()}}"
                                           target="_blank">{{$service->title ?? ''}}</a>
                                        {{--@if($row->vendor)
                                            <br>
                                            <span>{{__('by')}}</span>
                                            <a href="{{route('user.admin.detail',['id'=>$row->vendor_id])}}"
                                               target="_blank">{{$row->vendor->name_or_email.' (#'.$row->vendor_id.')' }}</a>
                                        @endif--}}
                                    @else
                                        {{__("[Deleted]")}}
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        <li>{{__("Name:")}} {{$row->first_name}} {{$row->last_name}} </li>

                                        <li>{{__("Phone:")}} {{$row->phone}}</li>

                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li>{{__("Make:")}} {{$row->vehicle_manufacture}}</li>
                                        <li>{{__("Model:")}} {{$row->vehicle_model}}</li>
                                        <li>{{__("Color:")}} {{$row->vehicle_color}}</li>
                                        <li>{{__("Registration:")}} {{$row->vehicle_registration}}</li>
                                    </ul>
                                </td>
                                <td>
                                    {{$booking->customer != null && $booking->customer->booking_agent ? $booking->customer->name : 'EMA'}}
                                </td>
                                <!--                                <td>{{__("Total")}} : {{format_money_main($row->total)}}<br/>
                                    {{__("Paid")}} : {{format_money_main($row->paid)}}<br/>

                                </td>-->
                                <!--                                <td>
                                    <span class="label label-{{$row->status}}">{{$row->statusName}}</span>
                                </td>-->
                                <!--                                <td>
                                    {{$row->gatewayObj ? $row->gatewayObj->getDisplayName() : ''}}
                                </td>-->
                                <td>{{display_datetime($row->start_date)}}</td>
                                <td>{{display_datetime($row->end_date)}}</td>
                                <td>
                                    @if($service = $row->service)
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">{{__('Actions')}}
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                 aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#modal_booking_detail"
                                                   data-ajax="{{route('booking.modal',['booking'=>$booking])}}"
                                                   data-toggle="modal" data-id="{{$booking->id}}"
                                                   data-target="#modal_booking_detail">{{__('Detail')}}</a>
                                                <a class="dropdown-item" href="#modal_booking_append"
                                                   data-ajax="{{route('booking.append',['booking'=>$booking])}}"
                                                   data-toggle="modal" data-id="{{$booking->id}}"
                                                   data-target="#modal_booking_append">{{__('Append')}}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#modal-checkIn-{{$row->id}}">{{__('Check In')}}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#modal-checkOut-{{$row->id}}">{{__('Check Out')}}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#modal-priotize-{{$row->id}}">{{__('Priotize')}}</a>

                                                @if($booking->status != 'no_show')
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#modal-no-show-{{$row->id}}">{{__('No Show')}}</a>
                                                @endif
                                                @if($booking->statusName == 'Pending amendment')
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-booking-amend-{{$booking->id}}">
                                                        {{__("Amendment Status")}}
                                                    </a>
                                                @endif
                                                @if($booking->statusName == 'Pending cancellation')
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-booking-cancel-{{$booking->id}}">
                                                        {{__("Cancellation Status")}}
                                                    </a>
                                                @endif

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#modal-confirmation-{{$row->id}}">{{__('Resend Confirmation')}}</a>
                                            </div>
                                        </div>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @foreach($rows as $booking)
                    @if($booking->status != 'no_show')
                        <div class="modal fade" id="modal-no-show-{{$booking->id}}">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{__("Booking ID")}}: #{{$booking->id}}
                                            Mark as No Show</h4>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="booking-review">
                                            <div class="booking-review-content">
                                                <div class="review-section total-review">
                                                    <ul class="review-list">
                                                        <li class="final-total d-block border-0">
                                                            <p class="text-center">Are you sure you want to mark as no show?</p>
                                                            <div class="d-flex justify-content-between">
                                                                <form
                                                                    action="{{route('report.admin.booking.noShow', [$booking->id])}}"
                                                                    class="form-inline mx-auto"
                                                                    method="POST">
                                                                    @csrf

                                                                    <button class="btn btn-success"
                                                                            type="submit">Yes
                                                                    </button>
                                                                </form>
                                                            </div>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                                        <span class="btn btn-secondary"
                                                              data-dismiss="modal">{{__("Close")}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="modal fade" id="modal-priotize-{{$booking->id}}">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__("Booking ID")}}: #{{$booking->id}}
                                        Priotize</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="booking-review">
                                        <div class="booking-review-content">
                                            <div class="review-section total-review">
                                                <ul class="review-list">
                                                    <li class="final-total d-block border-0">
                                                        <p class="text-center">Are you sure you want to priotize?</p>
                                                        <div class="d-flex justify-content-between">
                                                            <form
                                                                action="{{route('report.admin.booking.priotize', [$booking->id])}}"
                                                                class="form-inline mx-auto"
                                                                method="POST">
                                                                @csrf

                                                                <button class="btn btn-success"
                                                                        type="submit">Yes
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                                        <span class="btn btn-secondary"
                                                              data-dismiss="modal">{{__("Close")}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-confirmation-{{$booking->id}}">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__("Booking ID")}}: #{{$booking->id}}
                                        Priotize</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="booking-review">
                                        <div class="booking-review-content">
                                            <div class="review-section total-review">
                                                <ul class="review-list">
                                                    <li class="final-total d-block border-0">
                                                        <p class="text-center">Are you sure you want to resend confirmation email?</p>
                                                        <div class="d-flex justify-content-between">
                                                            <form
                                                                action="{{route('report.admin.booking.resend-confirmation', [$booking->id])}}"
                                                                class="form-inline mx-auto"
                                                                method="POST">
                                                                @csrf

                                                                <button class="btn btn-success"
                                                                        type="submit">Yes
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                                        <span class="btn btn-secondary"
                                                              data-dismiss="modal">{{__("Close")}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-checkIn-{{$booking->id}}">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__("Booking ID")}}: #{{$booking->id}}
                                        CheckIn</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="booking-review">
                                        <div class="booking-review-content">
                                            <div class="review-section total-review">
                                                <ul class="review-list">
                                                    <li class="final-total d-block border-0">
                                                        <div class="d-flex justify-content-between">
                                                            <form
                                                                action="{{route('report.admin.booking.checkIn', [$booking->id])}}"
                                                                class="form-inline mx-auto"
                                                                method="POST">
                                                                @csrf
                                                                <input type="datetime-local"
                                                                       required
                                                                       value="{{$booking->collection_time != null ? \Carbon\Carbon::parse($booking->collection_time) : \Carbon\Carbon::now()}}"
                                                                       step="any" name="date"
                                                                       class="form-control"/>
                                                                <input type="text"
                                                                       placeholder="driver name"
                                                                       name="driver"
                                                                       class="form-control"
                                                                       required/>
                                                                <button class="btn btn-success"
                                                                        type="submit">Save
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                                        <span class="btn btn-secondary"
                                                              data-dismiss="modal">{{__("Close")}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-checkOut-{{$booking->id}}">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__("Booking ID")}}: #{{$booking->id}}
                                        CheckOut</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="booking-review">
                                        <div class="booking-review-content">
                                            <div class="review-section total-review">
                                                <ul class="review-list">
                                                    <li class="final-total d-block border-0">
                                                        <div class="d-flex justify-content-between">
                                                            <form
                                                                action="{{route('report.admin.booking.checkOut', [$booking->id])}}"
                                                                method="POST"
                                                                class="form-inline mx-auto">
                                                                @csrf
                                                                <input type="datetime-local"
                                                                       value="{{$booking->return_time != null ? \Carbon\Carbon::parse($booking->return_time) : \Carbon\Carbon::now()}}"
                                                                       step="any" name="date"
                                                                       class="form-control"
                                                                       required/>
                                                                <input type="text"
                                                                       placeholder="driver name"
                                                                       required name="driver"
                                                                       class="form-control"/>
                                                                <button class="btn btn-success"
                                                                        type="submit">Save
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                                        <span class="btn btn-secondary"
                                                              data-dismiss="modal">{{__("Close")}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                        @if($booking->statusName == 'Pending cancellation')
                            @include ($booking->service->checkout_booking_detail_cancel_modal_file ?? '')
                        @endif
                        @if($booking->statusName == 'Pending amendment')
                            @include ($booking->service->checkout_booking_detail_amendment_modal_file ?? '')
                        @endif
                @endforeach
                <div class="modal" tabindex="-1" id="modal_booking_detail">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{__('Booking ID: #')}} <span class="user_id"></span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center">{{__("Loading...")}}</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{__('Close')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" tabindex="-1" id="modal_booking_append">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{__('Booking ID: #')}} <span class="user_id"></span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center">{{__("Loading...")}}</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{__('Close')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!empty($booking_manage_others))
                    <div class="modal fade" id="modal-addBooking">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Booking</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="booking-review">
                                        <div class="booking-review-content">
                                            <div class="review-section total-review">
                                                <ul class="review-list">
                                                    <li class="final-total d-block border-0">
                                                        <div class="">
                                                            <form action="{{route('report.admin.booking.add')}}"
                                                                  method="POST" class="mx-auto">
                                                                @csrf
                                                                <h5>Booking Detail</h5>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="arrival">Arrival:</label>
                                                                            <input type="datetime-local" value=""
                                                                                   step="any" name="arrival"
                                                                                   id="arrival" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="departure">Departure:</label>
                                                                            <input type="datetime-local" value=""
                                                                                   step="any" id="departure"
                                                                                   name="departure" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="reference">Reference No:</label>
                                                                            <input type="text" value="" id="reference"
                                                                                   name="reference" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="booking_date">Booking
                                                                                Date:</label>
                                                                            <input type="datetime-local"
                                                                                   value="{{\Carbon\Carbon::now()}}"
                                                                                   step="any" id="booking_date"
                                                                                   name="booking_date" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="flight_no">Flight No:</label>
                                                                            <input type="text" value="" id="flight_no"
                                                                                   name="flight_no"
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr/>
                                                                <h5>Vehicle Detail</h5>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="vehicle_registration">Registration:</label>
                                                                            <input type="text" value=""
                                                                                   id="vehicle_registration"
                                                                                   name="vehicle_registration" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="vehicle_manufacture">Manufacture:</label>
                                                                            <input type="text" value=""
                                                                                   id="vehicle_manufacture"
                                                                                   name="vehicle_manufacture" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="vehicle_model">Model:</label>
                                                                            <input type="text" value=""
                                                                                   id="vehicle_model"
                                                                                   name="vehicle_model" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="vehicle_color">Color:</label>
                                                                            <input type="text" value=""
                                                                                   id="vehicle_color"
                                                                                   name="vehicle_color" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr/>
                                                                <h5>Payment Detail</h5>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="product">Product:</label>
                                                                            <select class="form-control" required
                                                                                    name="object_id" id="product">
                                                                                <option selected value="" disabled>
                                                                                    Select a product
                                                                                </option>
                                                                                @foreach($spaces as $space)
                                                                                    <option
                                                                                        value="{{$space->id}}">{{$space->title}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="price">Price:</label>
                                                                            <input type="number" value="" id="price"
                                                                                   name="price" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <livewire:agent-customer-toggle></livewire:agent-customer-toggle>
                                                                    </div>
                                                                </div>


                                                                <hr/>
                                                                <h5>Customer Detail</h5>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="first_name">Firstname:</label>
                                                                            <input type="text" value="" id="first_name"
                                                                                   name="first_name" required
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="last_name">Lastname:</label>
                                                                            <input type="text" value="" id="last_name"
                                                                                   name="last_name"
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="phone">Phone:</label>
                                                                            <input type="text" value="" id="phone"
                                                                                   name="phone" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="email">Email:</label>
                                                                            <input type="text" value="" id="email"
                                                                                   name="email" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="address">Address:</label>
                                                                            <input type="text" value="" id="address"
                                                                                   name="address" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="address2">Address Line
                                                                                2:</label>
                                                                            <input type="text" value="" id="address2"
                                                                                   name="address2"
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="city">City:</label>
                                                                            <input type="text" value="" id="city"
                                                                                   name="city" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="state">State:</label>
                                                                            <input type="text" value="" id="state"
                                                                                   name="state" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="zip">Zip:</label>
                                                                            <input type="text" value="" id="zip"
                                                                                   name="zip" class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="country">Country:</label>
                                                                            <input type="text" value="United Kingdom"
                                                                                   id="country" name="country"
                                                                                   class="form-control"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="notes">Additional Notes:</label>
                                                                            <textarea id="notes" name="notes"
                                                                                      class="form-control"
                                                                                      rows="2"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr/>

                                                                <button class="btn btn-success" type="submit">Save
                                                                </button>
                                                            </form>
                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <span class="btn btn-secondary" data-dismiss="modal">{{__("Close")}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{$rows->withQueryString()->links()}}
        </div>
    </div>
@endsection
@push('js')
    <script>

        $(document).on('click', '#set_paid_btn', function (e) {
            var id = $(this).data('id');
            $.ajax({
                url: bookingCore.url + '/booking/setPaidAmount',
                data: {
                    id: id,
                    remain: $('#modal-paid-' + id + ' #set_paid_input').val(),
                },
                dataType: 'json',
                type: 'post',
                success: function (res) {
                    alert(res.message);
                    window.location.reload();
                }
            });
        });
        $('#modal_booking_detail').on('show.bs.modal', function (e) {
            var btn = $(e.relatedTarget);
            $(this).find('.user_id').html(btn.data('id'));
            $(this).find('.modal-body').html('<div class="d-flex justify-content-center">{{__("Loading...")}}</div>');
            var modal = $(this);
            $.get(btn.data('ajax'), function (html) {
                    modal.find('.modal-body').html(html);
                }
            )
        })

        $('#modal_booking_append').on('show.bs.modal', function (e) {
            var btn = $(e.relatedTarget);
            $(this).find('.user_id').html(btn.data('id'));
            $(this).find('.modal-body').html('<div class="d-flex justify-content-center">{{__("Loading...")}}</div>');
            var modal = $(this);
            $.get(btn.data('ajax'), function (html) {
                    modal.find('.modal-body').html(html);
                }
            )
        })

        $('.has-daterangepicker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            opens: 'left',
        }).on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        }).on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    </script>
@endpush
