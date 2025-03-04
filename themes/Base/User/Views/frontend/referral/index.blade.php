@extends('layouts.userDashboard.app')
@section('content')
    @section('pageTitle','My Referrals')
    @include('admin.message')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start  container-xxl ">

        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">

            <!--begin::Referral program-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Body-->
                <div class="card-body py-10">
                    <p class="fs-5 fw-semibold text-gray-600 py-6">
                        Welcome to your personalized Referral Dashboard! Here, you can easily track and manage all your referral activities. See how many friends you've referred, monitor their progress, and keep an eye on your rewards. Let's make referring as rewarding as possible!
                    </p>

                    <!--begin::Overview-->
                    <div class="row mb-10">
                        <!--begin::Col-->
                        <div class="col-xl-6 mb-15 mb-xl-0 pe-5">
                            <h4 class="mb-0">How to use Referral Program</h4>

                            <p class="fs-5 fw-semibold text-gray-600 pb-6">
                            <ol style="line-height: 30px;">
                                <li>
                                    <b>Share Your Link:</b> Use your unique referral link to invite friends to join. You can share it directly or through our built-in social sharing options.
                                </li>
                                <li>
                                    <b>Track Progress:</b> Monitor the status of your referrals in real-time. See who has signed up, who’s in progress, and who has completed the referral process.
                                </li>
                                <li>
                                    <b>Earn Rewards:</b> For every successful referral, you’ll earn exciting rewards. Track these rewards easily from your dashboard.
                                </li>
                            </ol>
                            </p>
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-xl-6">
                            <h4 class="text-gray-800 mb-0">
                                Your Referral Link
                            </h4>

                            <p class="fs-6 fw-semibold text-gray-600 py-4 m-0">
                                Click the "Copy Link" button to instantly copy your unique referral link.
                            </p>
                        
                            <div class="d-flex">
                                <input  type="text" class="form-control form-control-solid me-3 flex-grow-1" name="search" id="referLink" value="{{auth()->user()->getReferralLink()}}">

                                <button  class="btn btn-light btn-active-light-primary fw-bold flex-shrink-0 copyReferLink" data-clipboard-target="#kt_referral_link_input">Copy Link</button>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Overview-->


                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed  p-6">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-bank fs-2tx text-primary me-4"><span class="path1"></span><span class="path2"></span></i>        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                            <!--begin::Content-->
                            <div class="mb-3 mb-md-0 fw-semibold">
                                <h4 class="text-gray-900 fw-bold">Use Your Money in Bookings</h4>

                                <div class="fs-6 text-gray-700 pe-7">Create a new booking and use your credits inside checkout form</div>
                            </div>
                            <!--end::Content-->

                            <!--begin::Action-->
                            <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap">New Booking</a>
                            <!--end::Action-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Referral program-->


            <!--begin::Referred users-->
            <div class="card ">
                <!--begin::Header-->
                <div class="card-header card-header-stretch">
                    <!--begin::Title-->
                    <div class="card-title">
                        <h3>Referred Users</h3>
                    </div>
                    <!--end::Title-->

                </div>
                <!--end::Header-->

                <!--begin::Tab content-->
                <div id="kt_referred_users_tab_content" class="tab-content">

                    <!--begin::Tab panel-->
                    <div id="kt_referrals_1" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="kt_referrals_tab_1">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-bordered align-middle gy-6">
                                <!--begin::Thead-->
                                <thead class="border-bottom border-gray-200 fs-6 fw-bold bg-lighten">
                                <tr>
                                    <th class="min-w-125px ps-9">#</th>
                                    <th class="min-w-125px px-0">User</th>
                                    <th class="min-w-125px">Date</th>
                                    <th class="min-w-125px">Bonus</th>
                                    <th class="min-w-125px ps-0">Status</th>
                                </tr>
                                </thead>
                                <!--end::Thead-->

                                <!--begin::Tbody-->
                                <tbody class="fs-6 fw-semibold text-gray-600">
                                @if(count($referrals))
                                    @foreach($referrals as $key => $referral)

                                        <tr>
                                            @php $status = $referral->user->getReferralStatus(); @endphp
                                            <td class="ps-9">{{$key+1}}</td>
                                            <td class="ps-0"><a href="" class="text-gray-600 text-hover-primary">{{$referral->user->name}}</a></td>
                                            <td class="text-dark">{{display_datetime($referral->created_at)}}</td>
                                            <td>10%</td>
                                            <td class="text-{{$status=='Paid' ? 'success' : 'danger'}}">{{$status=='Paid' ? 'Confirmed' : 'Pending'}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="5">{{__("No data found")}}</td></tr>
                                @endif
                                </tbody>




                                </tbody>
                                <!--end::Tbody-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Tab panel-->

                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Referred users-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@section('extra')
    <div class="bravo-user-dashboard">
        <div class="row mb-2">
            <div class="col-lg-12 ">
                <div class="dashboard-item">
                    <div class="wrap-box">
                        <div class="title">
                            {{"Referral Link"}}
                        </div>
                        <div class="">
                            <a class="copyReferLink" href="#">{{__(':amount',['amount'=>auth()->user()->getReferralLink()])}}</a>
                            <input id="referLink" type="hidden" value="{{auth()->user()->getReferralLink()}}">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong >{{__("Latest Referrals")}}</strong></div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('User')}}</th>
                            <th scope="col">{{__('Status')}}</th>
                            <th scope="col">{{__("Date")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($referrals))
                            @foreach($referrals as $referral)

                                <tr>
                                    <td>{{$referral->user_id}}</td>
                                    <td>{{$referral->user->email}}</td>
                                    <td>{{$referral->user->getReferralStatus()}}</td>
                                    <td>{{display_datetime($referral->created_at)}}</td>

                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="5">{{__("No data found")}}</td></tr>
                        @endif
                        </tbody>

                    </table>
                    {{$referrals->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>

        $('.copyReferLink').on('click', function() {
            console.log('here');
            var val = $("#referLink").val();

            // Copy the text inside the text field
            navigator.clipboard.writeText(val);
            Swal.fire({
                title: "Success",
                text: "Referral link has been copied to clipboard.",
                icon: "success"
            });
        });

    </script>
@endpush
