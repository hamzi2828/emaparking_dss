@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center bravo-login-form-page bravo-login-page">
            <div class="col-md-5">
                @include('Layout::admin.message')
                <div class="">
                    <h1 class="">{{ __('Login') }}</h1>
                    @include('Layout::auth.login-form',['captcha_action'=>'login_normal'])
                </div>
            </div>
        </div>
    </div>
@endsection
