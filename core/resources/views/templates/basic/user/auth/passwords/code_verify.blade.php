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
                        <h4 class="section__title mb-0">@lang('Account Recovery')</h4>
                    </div>
                    <form class="account--form row g-4" action="{{ route('user.password.verify.code') }}" method="POST">
                        @csrf
                        <p class="verification-text text--white">@lang('A 6 digit verification code sent to your email address') :  {{ showEmailAddress($email) }}</p>
                        <input type="hidden" name="email" value="{{ $email }}">
                        @include($activeTemplate.'partials.verification_code')
                        <div class="form-group">
                            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                        </div>
                        <div class="form-group">
                           <p class="text--white"> @lang('Please check including your Junk/Spam Folder. if not found, you can') </p>
                            <a href="{{ route('user.password.request') }}">@lang('Try to send again')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .verification-code::after {
            display: none;
        }
    </style>
@endpush

