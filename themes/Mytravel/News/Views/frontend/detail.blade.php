@extends('layouts.app')
@push('css')
    <link href="{{ asset('themes/mytravel/dist/frontend/module/news/css/news.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">

@endpush
@section('content')
<div class="bravo-news">
    @php
        $title_page = setting_item_with_lang("news_page_list_title");
      
        if(!empty($custom_title_page)){
            $title_page = $custom_title_page;
        }
    @endphp
    <div class="bg-img-hero text-center mb-5 mb-lg-8" @if($bg = setting_item("news_page_list_banner")) style="background-image: url({{get_file_url($bg,'full')}})" @endif >
        <div class="container space-top-xl-3 py-6 py-xl-0">
            <div class="row justify-content-center py-xl-4">
                <div class="py-xl-10 py-5">
                    <h1 class="font-size-40 font-size-xs-30 text-white font-weight-bold mb-0">{{ $title_page }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter mb-0">
                            <li class="breadcrumb-item font-size-14"><a class="text-white" href="{{ url("/") }}">{{ __("Home") }}</a></li>
                            <li class="breadcrumb-item custom-breadcrumb-item font-size-14 text-white active" aria-current="page">{{ $title_page }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="bravo_content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    @include('News::frontend.layouts.details.news-detail')
                </div>
                <div class="col-md-3">
                    @include('News::frontend.layouts.details.news-sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


