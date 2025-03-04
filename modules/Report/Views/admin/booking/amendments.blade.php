@extends ('admin.layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('Booking Amendment Requests')}}</h1>
        </div>
        @include('admin.message')
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel booking-history-manager">
            <div class="panel-title">{{__('Bookings')}}</div>
            <div class="panel-body">
                <div class="bravo-form-item table-responsive">
                    <table class="table table-hover bravo-list-item">
                        <thead>
                        <tr>
                            <th width="80px">{{__('Status')}}</th>
                            <th>{{__('Service')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Vehicle')}}</th>
                            <th>{{__('Agent')}}</th>
                            <th width="120px">{{__('Arrival')}}</th>
                            <th width="120px">{{__('Return')}}</th>
                            <th width="80px">{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            @php  $booking = $row; @endphp
                            <tr>
                                <td>
                                    <span class=""> {{ucfirst($row->amendment_status())}}</span>
                                </td>
                                <td>
                                    @if($service = $booking->service)
                                        <a href="{{$service->getDetailUrl()}}"
                                           target="_blank">{{$service->title ?? ''}}</a>
                                    @else
                                        {{__("[Deleted]")}}
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        <li>{{__("Name:")}} {{$booking->first_name}} {{$booking->last_name}} </li>

                                        <li>{{__("Phone:")}} {{$booking->phone}}</li>

                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li>{{__("Make:")}} {{$booking->vehicle_manufacture}}</li>
                                        <li>{{__("Model:")}} {{$booking->vehicle_model}}</li>
                                        <li>{{__("Color:")}} {{$booking->vehicle_color}}</li>
                                        <li>{{__("Registration:")}} {{$booking->vehicle_registration}}</li>
                                    </ul>
                                </td>
                                <td>
                                    {{$booking->customer != null && $booking->customer->booking_agent ? $booking->customer->name : 'EMA'}}
                                </td>

                                <td>{{display_datetime($booking->start_date)}}</td>
                                <td>{{display_datetime($booking->end_date)}}</td>
                                <td>
                                    @if($service = $booking->service)
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
                                                   data-target="#modal_booking_detail">{{__('Booking Detail')}}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-booking-amend-{{$booking->id}}">
                                                    {{__("Amendment & Status")}}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

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
                @foreach($rows as $booking)
                    @include ($booking->service->checkout_booking_detail_amendment_modal_file ?? '')
                @endforeach


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
