@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{ __('Contact Infos') }}</h3>
        </div>
    </div>
    <div class="panel booking-history-manager">
        <div class="panel-title">Contact Infos</div>
        <div class="panel-body">
            <div class="bravo-form-item table-responsive overflow-lg-visible min-height-sm-300">
                <table class="table table-hover bravo-list-item">
                    <thead>
                        <tr>
                           <th>Sr #</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Message</th>
                           <th>Partner</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ @$loop->iteration }}</td>
                                <td>{{ @$contact->name }}</td>
                                <td>{{ @$contact->email }}</td>
                                <td>{{ @$contact->message }}</td>
                                <td>{{ @$contact->partners->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
