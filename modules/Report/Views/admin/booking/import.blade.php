@extends ('admin.layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('Import Bookings')}}</h1>
            @if(!empty($booking_manage_others))

                <span>
                    <a href="/module/booking/import-sample.csv">
                        <label class="btn bg-success">
                            <h5 class="m-0 h6 text-white">
                                Download Sample File
                            </h5>
                        </label>
                    </a>
                    <a href="#">
                        <label for="actual-btn" class="btn bg-info">
                            <h5 class="m-0 h6 text-white">
                                Choose File To Upload
                            </h5>
                        </label>
                    </a>
                    <a href="#" id="button_import_csv">
                        <label class="btn bg-dark">
                            <h5 class="m-0 h6 text-white">
                               Start Import Process
                            </h5>
                        </label>
                    </a>
                    <a href="{{route('report.admin.booking')}}">
                        <label class="btn bg-secondary">
                            <h5 class="m-0 h6 text-white">
                                Cancel Import Process
                            </h5>
                        </label>
                    </a>
                </span>
            @endif
        </div>
        @include('admin.message')
        <div class="card">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="text-center @error('import') my-4 @enderror">
                    <form id='import-form'  method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <input hidden name="import" id="actual-btn" class="form-control" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required/>
                        {{--@error('import')
                        <span class="text-danger">{{$message}}</span>
                        @enderror--}}
                        <div>
                            <button id="import-button" class="d-none" type="submit">Start import</button>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 m-4">
                    <div class="alert alert-success">
                        <strong>If you use Microsoft Excel or any other spreadsheet program to fill up your contact CSV then please make sure the values were saved properly by opening the file with notepad or any other text editor. See the below image please.</strong><br><br>
                        <img src="{{asset('images/import-sample.JPG')}}" width="100%" alt="sample_image">
                    </div>
                </div>
                @if (\Session::has('error_table'))
                    <div class="mx-4 mt-4">
                        <h6 class="ms-2 text-danger">Error Logs:</h6>
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reference #</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Booking Agent</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vehicle Info</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Errors</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (\Session::get('error_table') as $msg)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center ms-2">
                                                <h6 class="mb-0 text-sm">
                                                    {{$msg['row'][0]}}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$msg['row'][10]}}</p>

                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$msg['row'][11]. ' '.$msg['row'][12]}}</p>
                                        <p class="text-xs text-secondary mb-0">
                                            @php
                                                $address = $msg['row'][15];
                                                $address_length = strlen($address);
                                                if($address_length<40) {
                                                    echo $address;
                                                }
                                                else {
                                                    ?>
                                                    <span title="<?php echo $address ?>"  data-toggle="tooltip" data-placement="top">
                                                        <?php
                                                            echo substr($address, 0, 37).'...';
                                                        ?>
                                                    </span>
                                                    <?php
                                                }
                                            @endphp
                                        </p>
                                        <p class="text-xs text-secondary mb-0">{{$msg['row'][17].' '.$msg['row'][18]}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$msg['row'][20]. ' '.$msg['row'][19]}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$msg['row'][6]}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$msg['row'][4]}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$msg['row'][5]}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$msg['row'][7]}}</p>
                                    </td>

                                    <td class="align-middle">
                                        @foreach($msg['error'] as $key=> $error)
                                            <div class="text-xs font-weight-bold">{{($key+1).': '.$error}}</div>
                                        @endforeach
                                    </td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>

                @endif
        </div>

    </div>
@endsection
@push('js')
    <script>
        $('#button_import_csv').click(() => {
            $('#import-button').click()
        })
    </script>
@endpush
