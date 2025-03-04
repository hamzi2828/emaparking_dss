<div class="row">
    <div class="col-md-12">
        @include('Space::frontend.layouts.search.filter-search')
    </div>
    <div class="col-md-12">
        <div class="bravo-list-item">
            <div class="d-flex justify-content-between align-items-center mb-4 topbar-search">
                <h1 class="col-10 font-weight-bold mb-0 text-lh-1">Meet and Greet Parking Options at East Midlands Airport</h1>
               
                <div class="control">
                    @include('Space::frontend.layouts.search.orderby')
                </div>
            </div>
            <p>
                @if($rows->total() > 1)
                    {{ __(":count spaces found",['count'=>$rows->total()]) }}
                @else
                    {{ __(":count space found",['count'=>$rows->total()]) }}
                @endif
            </p>
            <div class="list-item">
                <div class="row">
                    @if($rows->total() > 0)
                        @foreach($rows as $row)
                            <div class="col-md-6 col-xl-4 mb-3 mb-md-4 pb-1">
                                @include('Space::frontend.layouts.search.loop-grid')
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            {{__("Space not found")}}
                        </div>
                    @endif
                </div>
            </div>
            @if($rows->total() > 0)
                <div class="text-center text-md-left font-size-14 mb-3 text-lh-1">{{ __("Showing :from - :to of :total Spaces",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</div>
            @endif
            {{$rows->appends(request()->query())->links()}}
            @if(!empty(Request::query('arrival_time')))
                @php
                    session()->put('arrival_time',Request::query('arrival_time'));
                @endphp
            @endif

            @if(!empty(Request::query('departure_time')))
                @php
                    session()->put('departure_time',Request::query('departure_time'));
                @endphp
            @endif
            @if(!empty(Request::query('coupon')))
                @php
                    session()->put('coupon',Request::query('coupon'));
                @endphp
            @else
                @php
                    session()->forget('coupon')
                @endphp

            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade productModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <livewire:product-details/>
        </div>
    </div>
</div>
@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        $('.spaceDetails').click(function () {
           id = $(this).data('id');
           window.Livewire.emit('getProduct',id)
        });
    </script>
@endpush
@push('css')
    <style>
        .featured {
            position: absolute;
            left: 0px;
            color: white;
            transform: none;
            top: 213px;
            padding: 5px;


            /* Legacy vendor prefixes that you probably don't need... */

            /* Safari */
            -webkit-transform: none;

            /* Firefox */
            -moz-transform: none;

            /* IE */
            -ms-transform: none;

            /* Opera */
            -o-transform: none;
            font-size: 22px;
        }
    </style>
@endpush
