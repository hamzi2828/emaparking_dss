<div class="booking-review">
    <div class="booking-review-content">
        <div class="review-section">
            <div class="info-form">
                <table class="table table-hover bravo-list-item">
                    <thead>
                        <tr>
                            <th>Reason</th>
                            <th width="200px">Edited By</th>
                            <th width="120px">Edited At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($booking->updateDetails as $append)
                            <tr>
                                <td>{{$append->reason}}</td>
                                <td>
                                    <div>
                                        {{$append->admin->name}}
                                    </div>
                                    <div>
                                        {{$append->admin->email}}
                                    </div>
                                </td>
                                <td>{{display_datetime($append->created_at)}}</td>
                            </tr>
                        @endforeach
                        @if($booking->updateDetails()->count() == 0)
                            <tr>
                                <td colspan="3">No edits found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
