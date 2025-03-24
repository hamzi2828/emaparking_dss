<div class="form-group">
    <label>{{ __('Customer Type')}}</label>
    <input class="d-none" wire:model="agent" name="booking_agent" type="checkbox" id="toggle-event" data-on="Booking Agent" data-off="Customer">
</div>

@push('css')

    <style>
        .toggle {
            width: 100% !important;
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
