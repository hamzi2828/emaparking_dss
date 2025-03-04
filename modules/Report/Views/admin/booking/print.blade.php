<!DOCTYPE html>
<html>
<head>
    <title>Key Logs</title>
    <link href="{{ public_path('libs/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
</head>
<style>
    .page-break {
        page-break-after: always;
    }
</style>
<body>
@foreach($bookings as $key => $booking)
    <div class="" style="width: 49%; display: inline-block;">
        <div class="card border border-dark p-2 my-3 mr-3">
            <div class="border-bottom border-dark">
                Reference: {{$booking->reference_no}}
            </div>
            <div class="border-bottom border-dark">
                Surname: {{$booking->first_name.' '.$booking->last_name}}
            </div>
            <div class="border-bottom border-dark">
                Mobile No: {{$booking->phone}}
            </div>
            <div class="border-bottom border-dark">
                Make/Color of Car: {{$booking->vehicle_manufacture}}
            </div>
            <div class="border-bottom border-dark">
                Registration No: {{$booking->vehicle_registration}}
            </div>
            <div class="border-bottom border-dark">
                Arrival Date/Time: {{$booking->start_date}}
            </div>
            <div class="border-bottom border-dark">
                Departure Date/Time: {{$booking->end_date}}
            </div>
            <div class="border-bottom border-dark">
                Flight No: {{$booking->flight_no}}
            </div>
            <div class="border-bottom border-dark">
                @php $extra_price = $booking->getJsonMeta('extra_price') @endphp
                Airport Charges: £12.00 {{!empty($extra_price) && ($booking->status=='paid' || $booking->status=='confirmed') ? "(Paid)" : ($booking->object_id =='16' ? '(Paid)' : "(Unpaid)") }}
            </div>
        </div>
    </div>
    @if(($key+1) % 6 == 0)
        <div class="page-break"></div>
    @endif
@endforeach

<script src="{{ public_path('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>



