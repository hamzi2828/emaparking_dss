@extends('layouts.app')
@push('css')
    <link href="{{ asset('themes/mytravel/dist/frontend/module/space/css/space.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("themes/mytravel/libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/fotorama/fotorama.css") }}"/>
@endpush
@section('content')

    <div class="bravo_detail_space">

        @include('Space::frontend.layouts.details.space-banner')
        <div class="bravo_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @php $review_score = $row->review_data @endphp
                        @include('Space::frontend.layouts.details.space-detail')
                        @include('Space::frontend.layouts.details.space-review')
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection

@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            "use strict"
            @if($row->map_lat && $row->map_lng)
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [{{$row->map_lat}}, {{$row->map_lng}}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {
                            iconUrl:"{{get_file_url(setting_item("space_icon_marker_map"),'full') ?? url('images/icons/png/pin.png') }}"
                        }
                    });
                }
            });
            @endif
        })
    </script>
{{--    <script>--}}
{{--        var bravo_booking_data = {!! json_encode($booking_data) !!}--}}
{{--            var bravo_booking_i18n = {--}}
{{--            no_date_select:'{{__('Please select Start and End date')}}',--}}
{{--            no_guest_select:'{{__('Please select at least one guest')}}',--}}
{{--            load_dates_url:'{{route('space.vendor.availability.loadDates')}}',--}}
{{--            name_required:'{{ __("Name is Required") }}',--}}
{{--            email_required:'{{ __("Email is Required") }}',--}}
{{--        };--}}
{{--    </script>--}}
    <script type="text/javascript" src="{{ asset("themes/mytravel/libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/fotorama/fotorama.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/sticky/jquery.sticky.js") }}"></script>
{{--    <script type="text/javascript" src="{{ asset('themes/mytravel/module/space/js/single-space2.js?_ver='.config('app.asset_version')) }}"></script>--}}
@endpush
