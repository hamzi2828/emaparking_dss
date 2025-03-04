@extends('layouts.app')
@push('css')
    <link href="{{ asset('dist/frontend/module/booking/css/checkout.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
@endpush
@section('content')
    <div class="bravo-booking-page">
        <div id="bravo-checkout-page" class="bg-gray space-2">
            <div class="container">
                <div class="row position-relative">
                    <div class="col-lg-8 col-xl-9">
                        <div class="booking-form m-0 p-0">
                            @include ($service->checkout_form_file ?? 'Booking::frontend/booking/checkout-form')
                            @if(!empty($token = request()->input('token')))
                                <input type="hidden" name="token" value="{{$token}}">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3 booking-form m-0 p-0 checkOutDetails bg-gray">
                        @include ($service->checkout_booking_detail_file ?? '')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .sticky {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('module/booking/js/checkout.js') }}"></script>
    <script type="text/javascript">
        jQuery(function () {
            "use strict"
            $.ajax({
                'url': bookingCore.url + '{{$is_api ? '/api' : ''}}/booking/{{$booking->code}}/check-status',
                'cache': false,
                'type': 'GET',
                success: function (data) {
                    if (data.redirect !== undefined && data.redirect) {
                        window.location.href = data.redirect
                    }
                }
            });
        })

        $('.deposit_amount').on('change', function(){
            checkPaynow();
        });

        $('input[type=radio][name=how_to_pay]').on('change', function(){
            checkPaynow();
        });

        function checkPaynow(){
            var credit_input = $('.deposit_amount').val();
            var how_to_pay = $("input[name=how_to_pay]:checked").val();
            var convert_to_money = credit_input * {{ setting_item('wallet_credit_exchange_rate',1)}};

            if(how_to_pay == 'full'){
                var pay_now_need_pay = parseFloat({{floatval($booking->total)}}) - convert_to_money;
            }else{
                var pay_now_need_pay = parseFloat({{floatval($booking->deposit == null ? $booking->total : $booking->deposit)}}) - convert_to_money;
            }

            if(pay_now_need_pay < 0){
                pay_now_need_pay = 0;
            }
            $('.convert_pay_now').html(bravo_format_money(pay_now_need_pay));
            $('.convert_deposit_amount').html(bravo_format_money(convert_to_money));
        }

        jQuery(function () {
            $(".bravo_apply_coupon").click(function () {
                var parent = $(this).closest('.section-coupon-form');
                parent.find(".group-form .fa-spin").removeClass("d-none");
                parent.find(".message").html('');
                $.ajax({
                    'url': bookingCore.url + '/booking/{{$booking->code}}/apply-coupon',
                    'data': parent.find('input,textarea,select').serialize(),
                    'cache': false,
                    'method':"post",
                    success: function (res) {
                        parent.find(".group-form .fa-spin").addClass("d-none");
                        if (res.reload !== undefined) {
                            window.location.reload();
                        }
                        if(res.message && res.status === 1)
                        {
                            parent.find('.message').html('<div class="alert alert-success">' + res.message+ '</div>');
                        }
                        if(res.message && res.status === 0)
                        {
                            parent.find('.message').html('<div class="alert alert-danger">' + res.message+ '</div>');
                        }
                    }
                });
            });
            $(".bravo_remove_coupon").click(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.section-coupon-form');
                var parentItem = $(this).closest('.item');
                parentItem.find(".fa-spin").removeClass("d-none");
                $.ajax({
                    'url': bookingCore.url + '/booking/{{$booking->code}}/remove-coupon',
                    'data': {
                        coupon_code:$(this).attr('data-code')
                    },
                    'cache': false,
                    'method':"post",
                    success: function (res) {
                        parentItem.find(".fa-spin").addClass("d-none");
                        if (res.reload !== undefined) {
                            window.location.reload();
                        }
                        if(res.message && res.status === 0)
                        {
                            parent.find('.message').html('<div class="alert alert-danger">' + res.message+ '</div>');
                        }
                    }
                });
            });
            @if(session()->get('coupon') != null)
                @php
                    session()->forget('coupon');
                @endphp
                $(".bravo_apply_coupon").click()
            @else
                @php
                    $code = getAutoApplyCoupon();
                @endphp
                @if($code !==null)
                    @if(session()->get('auto_coupon') == null)
                        $('input[name=coupon_code]').val('{{$code}}');
                        $(".bravo_apply_coupon").click()
                        @php
                            session()->put('auto_coupon',true)
                        @endphp
                    @else
                        @php
                            session()->forget('auto_coupon')
                        @endphp
                    @endif
                @endif
            @endif
        })

        window.onscroll = function() {myFunction()};

        // Get the header
        var header = document.getElementById("checkOutDetails");

        // Get the offset position of the navbar
        var sticky = header.offsetTop;

        // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>
@endpush
