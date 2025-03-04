<div>
    @if($review_list->total() > 0)
        <h5 class="font-size-21 font-weight-bold text-dark mb-5 mt-3">
            {{ __("Showing :from - :to of :total total",["from"=>$review_list->firstItem(),"to"=>$review_list->lastItem(),"total"=>$review_list->total()]) }}
        </h5>
    @else
        <h5 class="font-size-21 font-weight-bold text-dark mb-8">
            {{__("No Review")}}
        </h5>
    @endif
    @if($review_list)
        @foreach($review_list as $item)
            @php $userInfo = $item->author; @endphp
            <div class="media flex-column flex-md-row align-items-center align-items-md-start mb-4">
                <div class="mr-md-5">
                    <a class="d-block" href="#">
                        @if($avatar_url = $userInfo->getAvatarUrl())
                            <img class="img-fluid mb-3 mb-md-0 rounded-circle avatar-img" src="{{$avatar_url}}" alt="{{$userInfo->getDisplayName()}}">
                        @endif
                    </a>
                </div>
                <div class="media-body text-center text-md-left">
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-gray-3">
                            <a href="#">{{$userInfo->getDisplayName()}}</a>
                        </h6>
                        <div class="font-weight-normal font-size-14 text-gray-9 mb-2">{{display_datetime($item->created_at)}}</div>
                        <div class="d-flex align-items-center flex-column flex-md-row mb-2">
                            @php $score = $item->rate_number @endphp
                            @php
                                $filledStars = floor($score);
                                $halfFilled = $score - $filledStars;
                                $emptyStars = 5 - $filledStars - ceil($halfFilled);
                            @endphp

                            @for ($i = 0; $i < $filledStars; $i++)
                                <svg role="img" width="19" height="19" viewBox="2 2 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Filled star</title><defs><clipPath id="clip-1hjknto3n0dbfa1b08003eb"><rect width="8" height="7.6636257" x="3.9863169" y="4.3568988"></rect></clipPath></defs><g id="decimal-star"><path id="border-star" fill-rule="evenodd" clip-rule="evenodd" d="M 13.3854,6.01933 10.1084,5.52017 8.64374,2.41743 c -0.26243,-0.55305 -1.0228,-0.56008 -1.28748,0 L 5.89159,5.52017 2.61459,6.01933 C 2.02693,6.10838 1.79141,6.86532 2.21758,7.29886 L 4.58842,9.71263 4.02767,13.1224 c -0.10093,0.6163 0.52037,1.078 1.04075,0.7897 L 8,12.3021 l 2.9316,1.61 c 0.5204,0.2859 1.1417,-0.1734 1.0407,-0.7897 L 11.4116,9.71263 13.7824,7.29886 C 14.2086,6.86532 13.9731,6.10838 13.3854,6.01933 Z M 10.238,11.8199 9.80791,9.20473 11.6987,7.27971 9.09291,6.88279 8,4.56758 6.90709,6.88279 4.30131,7.27971 6.19209,9.20473 5.76202,11.8199 8,10.5908 Z" style="fill: rgb(255, 208, 0); fill-opacity: 1;"></path><path id="inner" d="M 10.365089,11.940869 9.9112316,9.2401755 11.906508,7.2522018 9.1567203,6.8423012 8.0034155,4.4513771 6.8501108,6.8423012 4.100334,7.2522018 6.0955995,9.2401755 5.6417636,11.940869 8.0034155,10.671574 Z" style="fill: rgb(255, 208, 0); clip-path: url(&quot;#clip-1hjknto3n0dbfa1b08003eb&quot;);"></path></g></svg>
                            @endfor

                            @if ($halfFilled > 0)
                                <svg role="img" width="19" height="19" viewBox="2 2 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Partial star</title><defs><clipPath id="clip-1hjknrnk10dc3def344c1cd"><rect width="4.04" height="7.6636257" x="3.9863169" y="4.3568988"></rect></clipPath></defs><g id="decimal-star"><path id="border-star" fill-rule="evenodd" clip-rule="evenodd" d="M 13.3854,6.01933 10.1084,5.52017 8.64374,2.41743 c -0.26243,-0.55305 -1.0228,-0.56008 -1.28748,0 L 5.89159,5.52017 2.61459,6.01933 C 2.02693,6.10838 1.79141,6.86532 2.21758,7.29886 L 4.58842,9.71263 4.02767,13.1224 c -0.10093,0.6163 0.52037,1.078 1.04075,0.7897 L 8,12.3021 l 2.9316,1.61 c 0.5204,0.2859 1.1417,-0.1734 1.0407,-0.7897 L 11.4116,9.71263 13.7824,7.29886 C 14.2086,6.86532 13.9731,6.10838 13.3854,6.01933 Z M 10.238,11.8199 9.80791,9.20473 11.6987,7.27971 9.09291,6.88279 8,4.56758 6.90709,6.88279 4.30131,7.27971 6.19209,9.20473 5.76202,11.8199 8,10.5908 Z" style="fill: rgb(255, 208, 0); fill-opacity: 1;"></path><path id="inner" d="M 10.365089,11.940869 9.9112316,9.2401755 11.906508,7.2522018 9.1567203,6.8423012 8.0034155,4.4513771 6.8501108,6.8423012 4.100334,7.2522018 6.0955995,9.2401755 5.6417636,11.940869 8.0034155,10.671574 Z" style="fill: rgb(255, 208, 0); clip-path: url(&quot;#clip-1hjknrnk10dc3def344c1cd&quot;);"></path></g></svg>
                            @endif

                            @for ($i = 0; $i < $emptyStars; $i++)
                                <svg role="img" width="19" height="19" viewBox="2 2 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Empty star</title><g id="decimal-star"><path id="border-star" fill-rule="evenodd" clip-rule="evenodd" d="M 13.3854,6.01933 10.1084,5.52017 8.64374,2.41743 c -0.26243,-0.55305 -1.0228,-0.56008 -1.28748,0 L 5.89159,5.52017 2.61459,6.01933 C 2.02693,6.10838 1.79141,6.86532 2.21758,7.29886 L 4.58842,9.71263 4.02767,13.1224 c -0.10093,0.6163 0.52037,1.078 1.04075,0.7897 L 8,12.3021 l 2.9316,1.61 c 0.5204,0.2859 1.1417,-0.1734 1.0407,-0.7897 L 11.4116,9.71263 13.7824,7.29886 C 14.2086,6.86532 13.9731,6.10838 13.3854,6.01933 Z M 10.238,11.8199 9.80791,9.20473 11.6987,7.27971 9.09291,6.88279 8,4.56758 6.90709,6.88279 4.30131,7.27971 6.19209,9.20473 5.76202,11.8199 8,10.5908 Z" style="fill: rgb(255, 208, 0); fill-opacity: 1;"></path><path id="inner" d="M 10.365089,11.940869 9.9112316,9.2401755 11.906508,7.2522018 9.1567203,6.8423012 8.0034155,4.4513771 6.8501108,6.8423012 4.100334,7.2522018 6.0955995,9.2401755 5.6417636,11.940869 8.0034155,10.671574 Z"></path></g></svg>
                            @endfor
                            <span class="font-weight-bold text-gray-3 mt-2 pt-1 pl-2">{{$item->title !=null ? $item->title : 'Verified Customer'}}</span>
                        </div>
                        <p class="text-lh-1dot6 mb-0 pr-lg-5">{{$item->content}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @if($review_list->total() > 0)
        <div class="product-pagination d-flex justify-content-center">
            {{$review_list->links()}}
        </div>
    @endif
        <style>
            .product-pagination .pagination .page-item .page-link {
                background: none;
                border: 1px solid #5191FA;
            }
            .product-pagination .pagination {
                border: none;
            }

            .product-pagination .pagination .page-item .page-link {
             color: #5191FA;
                border-radius: 10px;
            }

            .product-pagination .pagination .active .page-link {
                color: white !important;
            }

            .product-pagination .pagination .disabled .page-link {
                color: gray !important;
                border: 1px solid gray;
            }
        </style>
</div>
