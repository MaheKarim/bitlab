@extends($activeTemplate.'layouts.auth_master')

@php
    $bgImage = getContent('auth_background_iamge.content', true);
@endphp

@section('content')
    <div class="account-section bg_img" data-background="{{ getImage('assets/images/frontend/auth_background_iamge/' .@$bgImage->data_values->image, '1920x1080') }}">
        <div class="account__section-wrapper">
            <div class="account__section-thumb">
                <div class="logo d-none d-lg-block">
                    <a href="{{ route('home') }}">
                        <img src="{{getImage(getFilePath('logoIcon') .'/logo.png')}}" alt="@lang('logo')">
                    </a>
                </div>
            </div>
            <div class="account__section-content bg--title">
                <div class="w-100">
                    <div class="logo mb-5 d-lg-none">
                        <a href="{{ route('home') }}">
                            <img src="{{getImage(getFilePath('logoIcon') .'/logo.png')}}" alt="@lang('logo')">
                        </a>
                    </div>
                    <div class="section__header text--white">
                        <h4 class="section__title mb-0">@lang('Reset Password')</h4>
                    </div>
                    <form class="account--form row g-4" method="POST" action="{{ route('user.password.update') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="col-sm-12 hover-input-popup">
                            <label for="password" class="form--label-2">@lang('Password')</label>
                            <input id="password" type="password" class="form--control-2 @error('password') is-invalid @enderror" name="password" required>
                            @if(gs('secure_password'))
                                <div class="input-popup">
                                    <p class="error lower">@lang('1 small letter minimum')</p>
                                    <p class="error capital">@lang('1 capital letter minimum')</p>
                                    <p class="error number">@lang('1 number minimum')</p>
                                    <p class="error special">@lang('1 special character minimum')</p>
                                    <p class="error minimum">@lang('6 character password')</p>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-12 hover-input-popup">
                            <label for="password-confirm" class="form--label-2">@lang('Confirm Password')</label>
                            <input id="password-confirm" type="password" class="form--control-2" name="password_confirmation" required>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn w-100">@lang('Reset Password')</button>
                        </div>
                    </form>
                    <div class="mt-4 text-center text--white">
                        <a href="{{ route('user.login') }}" >@lang('Login Here')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .hover-input-popup {
            position: relative;
        }
        .hover-input-popup:hover .input-popup {
            opacity: 1;
            visibility: visible;
        }
        .input-popup {
            position: absolute;
            bottom: 130%;
            left: 50%;
            width: 280px;
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -ms-border-radius: 5px;
            -o-border-radius: 5px;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .input-popup::after {
            position: absolute;
            content: '';
            bottom: -19px;
            left: 50%;
            margin-left: -5px;
            border-width: 10px 10px 10px 10px;
            border-style: solid;
            border-color: transparent transparent #1a1a1a transparent;
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }
        .input-popup p {
            padding-left: 20px;
            position: relative;
        }
        .input-popup p::before {
            position: absolute;
            content: '';
            font-family: 'Line Awesome Free';
            font-weight: 900;
            left: 0;
            top: 4px;
            line-height: 1;
            font-size: 18px;
        }
        .input-popup p.error {
            text-decoration: line-through;
        }
        .input-popup p.error::before {
            content: "\f057";
            color: #ea5455;
        }
        .input-popup p.success::before {
            content: "\f058";
            color: #28c76f;
        }
    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";
            @if(gs('secure_password'))
            $('input[name=password]').on('input',function(){
                secure_password($(this));
            });
            @endif
        })(jQuery);
    </script>
@endpush
