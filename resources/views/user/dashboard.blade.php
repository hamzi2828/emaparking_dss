@extends('layouts.userDashboard.app')

@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Index-->
            <div class="card card-page" style="position: relative;">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row gy-5 g-md-8">
                        <!--begin::Col-->
                        <div class="col-xl-6">
                            <!--begin::Table Widget 1-->
                            <div class="card card-xl-stretch">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5 pb-3">
                                    <!--begin::Card title-->
                                    <h3 class="card-title fw-bolder text-gray-800 fs-2">Latest Bookings</h3>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <div class="my-1">
                                            <!--begin::Select-->
                                            <select class="form-select fw-bold w-125px" data-control="select2" data-placeholder="Status" data-hide-search="true">
                                                <option value="1" selected="selected">Status</option>
                                                <option value="2">Pending</option>
                                                <option value="3">In Progress</option>
                                                <option value="3">Complete</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-0">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-bordered table-row-dashed gy-5" id="kt_table_widget_1">
                                            <!--begin::Table body-->
                                            <tbody>
                                            <!--begin::Table row-->
                                            <tr class="text-start text-gray-400 fw-boldest fs-7 text-uppercase">
                                                <th class="min-w-200px px-0">Booking #</th>
                                                <th class="min-w-125px">Status</th>
                                                <th class="text-end pe-2 min-w-70px">Action</th>
                                            </tr>
                                            <!--end::Table row-->
                                            @foreach($stats['bookings'] as $booking)
                                                <tr>
                                                    <!--begin::Author=-->
                                                    <td class="p-0">
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Logo-->
                                                            <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img alt="" class="w-40px" src="{{$booking->service->image_url ?? '/images/mp.png'}}" />
                                                            </span>
                                                            </div>
                                                            <!--end::Logo-->
                                                            <div class="ps-3">
                                                                <a href="#" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">{{$booking->reference_no}}</a>
                                                                <span class="text-gray-400 fw-bold d-block">Arrival: {{$booking->start_date}}</span>
                                                                <span class="text-gray-400 fw-bold d-block">Departure: {{$booking->end_date}}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <!--end::Author=-->
                                                    <!--begin::Progress=-->
                                                    <td>
                                                        <div class="d-flex flex-column w-100 me-2 mt-2">
                                                            <span class="text-gray-400 me-2 fw-boldest mb-2">{{ucfirst($booking->status)}}</span>
                                                            @php
                                                                $progress = $booking->getProgressStatus();
                                                            @endphp
                                                            <div class="progress bg-light-{{$progress[1]}} w-100 h-5px">

                                                                <div class="progress-bar bg-{{$progress[1]}}" role="progressbar" style="width: {{$progress[0]}}%"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <!--end::Company=-->
                                                    <!--begin::Action=-->
                                                    <td class="pe-0 text-end">
                                                        <a href="#" class="btn btn-sm btn-icon btn-color-gray-500 btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-overflow="true" data-kt-menu-placement="bottom-start">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                            <span class="svg-icon svg-icon-2x">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black" />
                                                                                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
                                                                                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
                                                                                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
                                                                                    </svg>
                                                                                </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        <!--begin::Menu 3-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                                            <!--begin::Heading-->
<!--                                                            <div class="menu-item px-3">
                                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
                                                            </div>-->
                                                            <!--end::Heading-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="{{$booking->service->getDetailUrl()}}" class="menu-link px-3">Directions</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="{{route('user.booking.invoice',['code'=>$booking->code])}}" class="menu-link flex-stack px-3">Invoice
                                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
                                                            </div>

                                                        </div>
                                                        <!--end::Menu 3-->
                                                    </td>
                                                    <!--end::Action=-->
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Table Widget 1-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        @php  
                            $data = json_decode(json_encode($monthlyBookings,true),true) ;
                            $monthname = json_decode(json_encode($months,true),true); 
                        @endphp
                        <script>
                              var databooking = @json($data);
                              var months = @json($monthname);
                              
                        </script>
                        <div class="col-xl-6">
                            <!--begin::Row-->
                            <div class="row g-5 g-md-8">
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <!--begin::Statistics Widget 1-->
                                    <div class="card card-xl-stretch-50 mb-5 mb-md-8">
                                        <!--begin::Body-->
                                        <div class="card-body d-flex flex-column justify-content-between p-0">
                                            <!--begin::Hidden-->
                                            <div class="d-flex flex-column px-9 pt-5">
                                                <!--begin::Number-->
                                                <div class="text-success fw-boldest fs-2hx">{{ ($bookingcount)}}</div>
                                                <!--end::Number-->
                                                <!--begin::Description-->
                                                <span class="text-gray-400 fw-bold fs-6">Total Bookings</span>
                                                <!--end::Description-->
                                            </div>

                                            <!--end::Hidden-->
                                            <!--begin::Chart-->
                                            <div class="statistics-widget-1-chart card-rounded-bottom" data-kt-chart-color="success" style="height: 150px"></div>
                                            <!--end::Chart-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Statistics Widget 1-->
                                    <!--begin::Mixed Widget 1-->
                                    <div class="card card-xl-stretch-50 mb-xl-8">
                                        <!--begin::Body-->
                                        <div class="card-body pt-5 bg-primary rounded">
                                            <!--begin::Chart-->
                                            <div class="d-flex justify-content-between">
                                                <!--begin::Section-->
                                                <div class="d-flex flex-column justify-content-between text-start">
                                                    <h3 class="d-flex align-items-start flex-column">
                                                        <span class="card-label fw-bold fs-4 text-white">Midland's Credits</span>
                                                        <span class="mt-1 fw-semibold text-white fs-7">01.00 GBP for 1 Credit Point</span>
                                                    </h3>


                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <img  src="assets/media/illustrations/sigma-1/6.png" class="h-100px " alt="">
                                            </div>

                                            <!--end::Chart-->
                                            <!--begin::Label-->
                                            <span class="">
                                                        <span class="d-block fw-bold fs-2 text-white">{{$stats['balance']}} Credits</span>
                                                        <span class="mt-1 fw-semibold fs-3 text-white">~ £{{$stats['balance']}} GBP</span>
                                            </span>
                                            <!--end::Label-->

                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Mixed Widget 1-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <!--begin::Mixed Widget 2-->
                                    <div class="card card-xl-stretch-50 mb-5 mb-md-8">
                                        <!--begin::Body-->
                                        <div class="card-body d-flex flex-column justify-content-between p-0">
                                            <!--begin::Hidden-->
                                            <div class="d-flex flex-column px-9 pt-5">
                                                <!--begin::Number-->
                                                <span class="text-primary fw-boldest fs-2hx">{{$stats['total_referrals']}}</span>
                                                <!--end::Number-->
                                                <!--begin::Description-->
                                                <span class="text-gray-400 fw-bold fs-6">Total Referrals</span>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Hidden-->
                                            <!--begin::Chart-->
                                            <div id="kt_mixed_widget_2_chart" class="mx-3" data-kt-color="primary" style="height: 175px"></div>
                                            <!--end::Chart-->
                                        </div>
                                    </div>
                                    <!--end::Mixed Widget 2-->
                                    <!--begin::Engage widget 1-->
                                    <div class="card card-xxl-stretch-50" style="background-color: #1C53E1">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex align-items-end p-0 pt-10">
                                            <!--begin::Wrapper-->
                                            <div class="flex-grow-1 ps-9 pb-9">
                                                <!--begin::Items-->
                                                <div class="pt-8">
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center mb-3">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr059.svg-->
                                                        <span class="svg-icon svg-icon-3 svg-icon-white me-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M6.8 15.8C7.3 15.7 7.9 16 8 16.5C8.2 17.4 8.99999 18 9.89999 18H17.9C19 18 19.9 17.1 19.9 16V8C19.9 6.9 19 6 17.9 6H9.89999C8.79999 6 7.89999 6.9 7.89999 8V9.4H5.89999V8C5.89999 5.8 7.69999 4 9.89999 4H17.9C20.1 4 21.9 5.8 21.9 8V16C21.9 18.2 20.1 20 17.9 20H9.89999C8.09999 20 6.5 18.8 6 17.1C6 16.5 6.3 16 6.8 15.8Z" fill="black" />
                                                                                    <path opacity="0.3" d="M12 9.39999H2L6.3 13.7C6.7 14.1 7.3 14.1 7.7 13.7L12 9.39999Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                        <!--end::Svg Icon-->
                                                        <span class="fw-bolder fs-7 text-white">Choose Dates</span>
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center mb-3">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr059.svg-->
                                                        <span class="svg-icon svg-icon-3 svg-icon-white me-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M6.8 15.8C7.3 15.7 7.9 16 8 16.5C8.2 17.4 8.99999 18 9.89999 18H17.9C19 18 19.9 17.1 19.9 16V8C19.9 6.9 19 6 17.9 6H9.89999C8.79999 6 7.89999 6.9 7.89999 8V9.4H5.89999V8C5.89999 5.8 7.69999 4 9.89999 4H17.9C20.1 4 21.9 5.8 21.9 8V16C21.9 18.2 20.1 20 17.9 20H9.89999C8.09999 20 6.5 18.8 6 17.1C6 16.5 6.3 16 6.8 15.8Z" fill="black" />
                                                                                    <path opacity="0.3" d="M12 9.39999H2L6.3 13.7C6.7 14.1 7.3 14.1 7.7 13.7L12 9.39999Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                        <!--end::Svg Icon-->
                                                        <span class="fw-bolder fs-7 text-white">Select Product</span>
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center mb-5">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr059.svg-->
                                                        <span class="svg-icon svg-icon-3 svg-icon-white me-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M6.8 15.8C7.3 15.7 7.9 16 8 16.5C8.2 17.4 8.99999 18 9.89999 18H17.9C19 18 19.9 17.1 19.9 16V8C19.9 6.9 19 6 17.9 6H9.89999C8.79999 6 7.89999 6.9 7.89999 8V9.4H5.89999V8C5.89999 5.8 7.69999 4 9.89999 4H17.9C20.1 4 21.9 5.8 21.9 8V16C21.9 18.2 20.1 20 17.9 20H9.89999C8.09999 20 6.5 18.8 6 17.1C6 16.5 6.3 16 6.8 15.8Z" fill="black" />
                                                                                    <path opacity="0.3" d="M12 9.39999H2L6.3 13.7C6.7 14.1 7.3 14.1 7.7 13.7L12 9.39999Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                        <!--end::Svg Icon-->
                                                        <span class="fw-bolder fs-7 text-white">Fill Booking Form</span>
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                                <!--end::Items-->
                                                <!--begin::Link-->
                                                <a href="#" class="btn btn-sm btn-success" >New Booking</a>
                                                <!--end::Link-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <img class="mh-200px" alt="" src="assets/media/svg/illustrations/engage.svg" />
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Engage widget 1-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row g-5 g-md-8">
                        <!--begin::Col-->
                        <div class="col-xl-12">
                            <!--begin::List Widget 4-->
                            <div class="card card-xl-stretch mb-5 mb-xl-8">
                                <!--begin::Header-->
                                <div class="card-header align-items-center border-0 mt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="fw-bolder text-dark fs-2">Transactions</span>
                                        <span class="text-gray-400 mt-2 fw-bold fs-6">Recent transactions</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <a href="#" class="btn btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                                        </g>
                                                                    </svg>
                                                                </span>
                                            <!--end::Svg Icon-->
                                        </a>

                                        <!--end::Menu-->
                                    </div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-1">
                                    @foreach($stats['transactions'] as $transaction)
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack item-border-hover px-3 py-2 ms-n4 mb-3">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-40px symbol-circle me-4">
                                                                    <span class="symbol-label bg-light-@if($transaction->status =='unpaid')danger @else()success @endif">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                                                        <span class="svg-icon svg-icon-1 svg-icon-danger">
                                                                            @if($transaction->status =='unpaid')
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                                                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                                                                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                                                                            </svg>
                                                                            @else
                                                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 117.72 117.72" style="enable-background:new 0 0 117.72 117.72" xml:space="preserve"><style type="text/css"><![CDATA[
                                                                                        .st0{fill:#01A601;}
                                                                                        ]]></style><g><path class="st0" d="M58.86,0c9.13,0,17.77,2.08,25.49,5.79c-3.16,2.5-6.09,4.9-8.82,7.21c-5.2-1.89-10.81-2.92-16.66-2.92 c-13.47,0-25.67,5.46-34.49,14.29c-8.83,8.83-14.29,21.02-14.29,34.49c0,13.47,5.46,25.66,14.29,34.49 c8.83,8.83,21.02,14.29,34.49,14.29s25.67-5.46,34.49-14.29c8.83-8.83,14.29-21.02,14.29-34.49c0-3.2-0.31-6.34-0.9-9.37 c2.53-3.3,5.12-6.59,7.77-9.85c2.08,6.02,3.21,12.49,3.21,19.22c0,16.25-6.59,30.97-17.24,41.62 c-10.65,10.65-25.37,17.24-41.62,17.24c-16.25,0-30.97-6.59-41.62-17.24C6.59,89.83,0,75.11,0,58.86 c0-16.25,6.59-30.97,17.24-41.62S42.61,0,58.86,0L58.86,0z M31.44,49.19L45.8,49l1.07,0.28c2.9,1.67,5.63,3.58,8.18,5.74 c1.84,1.56,3.6,3.26,5.27,5.1c5.15-8.29,10.64-15.9,16.44-22.9c6.35-7.67,13.09-14.63,20.17-20.98l1.4-0.54H114l-3.16,3.51 C101.13,30,92.32,41.15,84.36,52.65C76.4,64.16,69.28,76.04,62.95,88.27l-1.97,3.8l-1.81-3.87c-3.34-7.17-7.34-13.75-12.11-19.63 c-4.77-5.88-10.32-11.1-16.79-15.54L31.44,49.19L31.44,49.19z"/></g></svg>
                                                                            @endif
                                                                        </span>
                                                                        <!--end::Svg Icon-->
                                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Title-->
                                                <div class="ps-1 mb-1">
                                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">
                                                        @if(!empty($transaction->meta['admin_deposit']))
                                                            {{__("Deposit by :name",['name'=>$transaction->author->display_name ?? ''])}}
                                                        @elseif(!empty($transaction->meta['user_deposit']))
                                                            {{__("Deposit by card")}}


                                                        @elseif(!empty($transaction->meta['wallet_total_used']))
                                                            {{__(":credit credits used on :booking",['credit'=>$transaction->meta['wallet_total_used'] ?? '', 'booking' => $transaction->meta['description'] ?? ''])}}

                                                        @elseif(!empty($transaction->meta['referral_commission']))
                                                            {{__(":credit credits earned from :booking",['credit'=>$transaction->meta['referral_commission'] ?? '', 'booking' => $transaction->meta['description'] ?? ''])}}
                                                        @else
                                                            {{__("Deposit by card")}}
                                                        @endif
                                                    </a>
                                                    <div class="text-gray-400 fw-bold">{{$transaction->created_at->format('d M Y H:i A')}}</div>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Section-->
                                            <!--begin::Label-->
                                            <span class="badge badge-light rounded-pill fs-7 fw-boldest">{{$transaction->type == 'deposit' ? '+': ''}}{{$transaction->amountFloat}} Credits</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    @endforeach

                                    <!--begin::Item-->
<!--                                    <div class="d-flex flex-stack item-border-hover px-3 py-2 ms-n4 mb-3">
                                        &lt;!&ndash;begin::Section&ndash;&gt;
                                        <div class="d-flex align-items-center">
                                            &lt;!&ndash;begin::Symbol&ndash;&gt;
                                            <div class="symbol symbol-40px symbol-circle me-4">
                                                                    <span class="symbol-label bg-light-success">
                                                                        &lt;!&ndash;begin::Svg Icon | path: icons/duotune/files/fil023.svg&ndash;&gt;
                                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path opacity="0.3" d="M5 15C3.3 15 2 13.7 2 12C2 10.3 3.3 9 5 9H5.10001C5.00001 8.7 5 8.3 5 8C5 5.2 7.2 3 10 3C11.9 3 13.5 4 14.3 5.5C14.8 5.2 15.4 5 16 5C17.7 5 19 6.3 19 8C19 8.4 18.9 8.7 18.8 9C18.9 9 18.9 9 19 9C20.7 9 22 10.3 22 12C22 13.7 20.7 15 19 15H5ZM5 12.6H13L9.7 9.29999C9.3 8.89999 8.7 8.89999 8.3 9.29999L5 12.6Z" fill="black" />
                                                                                <path d="M17 17.4V12C17 11.4 16.6 11 16 11C15.4 11 15 11.4 15 12V17.4H17Z" fill="black" />
                                                                                <path opacity="0.3" d="M12 17.4H20L16.7 20.7C16.3 21.1 15.7 21.1 15.3 20.7L12 17.4Z" fill="black" />
                                                                                <path d="M8 12.6V18C8 18.6 8.4 19 9 19C9.6 19 10 18.6 10 18V12.6H8Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                        &lt;!&ndash;end::Svg Icon&ndash;&gt;
                                                                    </span>
                                            </div>
                                            &lt;!&ndash;end::Symbol&ndash;&gt;
                                            &lt;!&ndash;begin::Title&ndash;&gt;
                                            <div class="ps-1 mb-1">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">Project Rider</a>
                                                <div class="text-gray-400 fw-bold">New frontend admin theme</div>
                                            </div>
                                            &lt;!&ndash;end::Title&ndash;&gt;
                                        </div>
                                        &lt;!&ndash;end::Section&ndash;&gt;
                                        &lt;!&ndash;begin::Label&ndash;&gt;
                                        <span class="badge badge-light rounded-pill fs-7 fw-boldest">75 files</span>
                                        &lt;!&ndash;end::Label&ndash;&gt;
                                    </div>-->
                                    <!--end::Item-->

                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 4-->
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

@section('pageTitle','Overview')

@push('css')
    <style>
        .dashboard-overlay {
            align-items: start;
        }
        .dashboard-overlay div {
            margin-top: 300px;
        }
    </style>
@endpush
