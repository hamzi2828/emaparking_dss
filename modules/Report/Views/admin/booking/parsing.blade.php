@extends ('admin.layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('Parsing Report')}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between">
            <div class="col-left">

            </div>
            <div class="col-left">

            </div>
        </div>
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
                            <th width="80px"><input type="checkbox" class="check-all"></th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Info')}}</th>
                            <th>{{__('Received at')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            @php  $booking = $row; @endphp
                            <tr>
                                <td><input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">
                                    #{{$row->id}}</td>
                                <td>
                                    <ul>
                                        <li>{{__("Email:")}} {{$row->email}}</li>

                                        <li>{{__("Subject:")}} {{$row->subject}}</li>

                                    </ul>
                                </td>
                                <td>{{$row->status}}</td>
                                <td>{{$row->error}}</td>
                                <td>{{display_datetime($row->created_at)}}</td>
                                <td>
                                    @if($row->status == 'failed')
                                        <a href="{{route('report.admin.booking.parsing.retry',[$row->id])}}" class="btn btn-warning btn-sm" type="button">
                                            {{__('Retry')}}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{$rows->links()}}
        </div>
    </div>
@endsection
@push('js')

@endpush
