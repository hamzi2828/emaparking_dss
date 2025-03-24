@extends('layouts.userDashboard.app')
@section('content')
    @include('admin.message')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Index-->
            <div class="row">
                <div class="col-md-6">
                    <!--begin::Card widget 11-->
                    <div class="card card-flush bg-primary h-xl-100">

                        <!--begin::Body-->
                        <div class="card-body text-center pt-5">
                            <div class="d-flex justify-content-between">
                                <!--begin::Section-->
                                <div class="d-flex flex-column justify-content-between text-start">
                                    <h3 class="d-flex align-items-start flex-column">
                                        <span class="card-label fw-bold fs-4 text-white">Midland's Credits</span>
                                        <span class="mt-1 fw-semibold text-white fs-7">01.00 GBP for 1 Credit Point</span>
                                    </h3>
                                    <div>
                                        <span class="d-block fw-bold fs-1 text-white">{{$row->balanceFloat}} Credits</span>
                                        <span class="mt-1 fw-semibold fs-3 text-white">~ £{{$row->balanceFloat}} GBP</span>
                                    </div>

                                </div>
                                <!--end::Section-->
                                <!--begin::Image-->
                                <img src="assets/media/illustrations/sigma-1/6.png" class="h-200px " alt="">
                                <!--end::Image-->
                            </div>

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 11-->
                </div>
                <div class="col-md-6">
                    <div class="card card-lg-stretch">
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Carousel-->
                            <div id="kt_security_guidelines" class="carousel carousel-custom carousel-stretch slide" data-bs-ride="carousel" data-bs-pause="5000" data-bs-interval="8000">
                                <!--begin::Heading-->
                                <div class="d-flex flex-stack align-items-center flex-wrap">
                                    <h4 class="text-gray-500 fw-semibold mb-0 pe-2">
                                        Security Guidelines
                                    </h4>

                                    <!--begin::Carousel Indicators-->
                                    <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                                        <li data-bs-target="#kt_security_guidelines" data-bs-slide-to="0" class="ms-1 active"></li>
                                        <li data-bs-target="#kt_security_guidelines" data-bs-slide-to="1" class="ms-1"></li>
                                        <li data-bs-target="#kt_security_guidelines" data-bs-slide-to="2" class="ms-1"></li>
                                    </ol>
                                    <!--end::Carousel Indicators-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Carousel inner-->
                                <div class="carousel-inner min-h-lg-175px pt-6">
                                    <!--begin::Item-->
                                    <div class="carousel-item active">
                                        <!--begin::Wrapper-->
                                        <div class="carousel-wrapper">
                                            <!--begin::Description-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary">
                                                    Get Start Your Security
                                                </a>

                                                <p class="text-gray-600 fs-6 fw-semibold pt-3 mb-0">
                                                    In the last year, you’ve probably had to adapt to new ways of living and working.
                                                </p>
                                            </div>
                                            <!--end::Description-->


                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="carousel-item">
                                        <!--begin::Wrapper-->
                                        <div class="carousel-wrapper">
                                            <!--begin::Description-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a href="#" class="fw-bold text-gray-900 text-hover-primary">
                                                    Security Policy Update
                                                </a>

                                                <p class="text-gray-600 fs-6 fw-semibold pt-3 mb-0">
                                                    As we approach one year of working remotely, we wanted to take a look back
                                                    and share some ways teams around the world have collaborated effectively.
                                                </p>
                                            </div>
                                            <!--end::Description-->

                                            <!--begin::Summary-->
                                            <div class="d-flex flex-stack pt-8">
                                                <span class="badge badge-light-primary fs-7 fw-bold me-2">Oct 05, 2021</span>

                                                <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-bold px-5">Explore</a>
                                            </div>
                                            <!--end::Summary-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="carousel-item">
                                        <!--begin::Wrapper-->
                                        <div class="carousel-wrapper">
                                            <!--begin::Description-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a href="#" class="fw-bold text-gray-900 text-hover-primary">
                                                    Terms Of Use Document
                                                </a>

                                                <p class="text-gray-600 fs-6 fw-semibold pt-3 mb-0">
                                                    Today we are excited to share an amazing certification
                                                    opportunity which is designed to teach you everything
                                                </p>
                                            </div>
                                            <!--end::Description-->

                                            <!--begin::Summary-->
                                            <div class="d-flex flex-stack pt-8">
                                                <span class="badge badge-light-primary fs-7 fw-bold me-2">Nov 10, 2021</span>

                                                <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-bold px-5">Discover</a>
                                            </div>
                                            <!--end::Summary-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Carousel inner-->
                            </div>
                            <!--end::Carousel-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card ">
                        <!--begin::Card header-->
                        <div class="card-header card-header-stretch border-bottom border-gray-200">
                            <!--begin::Title-->
                            <div class="card-title">
                                <h3 class="fw-bold m-0">Recent transactions</h3>
                            </div>
                            <!--end::Title-->

                            <!--begin::Toolbar-->
                            <div class="card-toolbar align-items-center m-0">
                                <!--begin::Tab nav-->
                                <div>
                                    <a href="{{route('user.wallet.transactions')}}" class="btn btn-primary rounded-4">View all</a>
                                </div>

                                <!--end::Tab nav-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card header-->

                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::Tab panel-->
                            <div id="kt_billing_months" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="kt_billing_months">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-row-bordered align-middle gy-4 gs-9">
                                        <thead class="border-bottom border-gray-200 fs-6 text-gray-600 fw-bold bg-light bg-opacity-75">
                                        <tr>
                                            <td class="min-w-150px">Date</td>
                                            <td class="min-w-250px">Description</td>
                                            <td class="min-w-150px">Amount</td>
                                            <td class="min-w-150px">Type</td>
                                            <td class="min-w-150px">Status</td>

                                        </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-800">
                                        <!--begin::Table row-->
                                        @if(count($transactions))
                                            @foreach($transactions as $transaction)
                                                <tr>

                                                    <td>{{$transaction->created_at->format('d M Y')}}</td>
                                                    <td>
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
                                                    </td>
                                                    <td>{{$transaction->amountFloat}}</td>
                                                    <td>{{ucfirst($transaction->type)}}</td>
                                                    <td><span class="badge badge-{{$transaction->status_class}}">{{$transaction->status_name ?? ''}}</span></td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="5">{{__("No transactions found")}}</td></tr>
                                        @endif

                                        <!--end::Table row-->
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table container-->
                            </div>
                        </div>
                        <!--end::Tab Content-->
                    </div>
                </div>
            </div>

            <!--end::Index-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@section('pageTitle','My Wallet')
