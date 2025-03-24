<div>


    <div class="form-group">
        <input class="d-none" wire:model="agent" type="checkbox" id="toggle-event" data-on="Booking Agent" data-off="Customer">
        <select class="form-control" required name="customer_id" id="customer">
            <option selected value="" disabled>Select a @if($agent) booking agent @else customer @endif</option>
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
</div>
@push('css')

    <style>
        .toggle {
            width: 150px !important;
        }
    </style>
@endpush

@push('js')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.processed', (message, component) => {
                $('#toggle-event').bootstrapToggle();
            })
            $('#toggle-event').change(function() {
                Livewire.emit('toggle')
                setTimeout(() => {
                    $('#toggle-event').bootstrapToggle('destroy')
                },200)

            })

            $('#toggle-event').bootstrapToggle();
        });
    </script>
@endpush
