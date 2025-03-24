@extends('layouts.userDashboard.app')
@section('content')
    @include('admin.message')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Index-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card pb-4">
                        <!--begin::Card header-->
                        <div class="card-header card-header-stretch border-bottom border-gray-200">
                            <!--begin::Title-->
                            <div class="card-title">
                                <h3 class="fw-bold m-0">All Transactions</h3>
                            </div>
                            <!--end::Title-->
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
                        {{$transactions->links()}}
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
