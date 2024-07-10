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
                    <form class="account--form row g-4" method="POST" action="{{ route('user.password.email') }}">
                        @csrf
                        <div class="col-sm-12">
                            <label for="username" class="form--label-2">@lang('Select One')</label>
                            <select class="form--control-2" name="type">
                                <option value="email">@lang('E-Mail Address')</option>
                                <option value="username">@lang('Username')</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="password" class="form--label-2 my_value"></label>
                            <input type="text" class="form--control-2 @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required>
                            @error('value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <x-captcha />
                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn w-100">@lang('Send Password Code')</button>
                        </div>
                        <div class="mt-3 text--white">
                            @lang('Go to login')
                            <a href="{{ route('user.login') }}">@lang('Login')</a>
                            @lang('Page')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>

        (function($){
            "use strict";

            myVal();
            $('select[name=type]').on('change',function(){
                myVal();
            });
            function myVal(){
                $('.my_value').text($('select[name=type] :selected').text());
            }
        })(jQuery)
    </script>
@endpush
