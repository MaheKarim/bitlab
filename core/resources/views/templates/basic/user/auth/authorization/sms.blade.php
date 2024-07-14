@extends($activeTemplate.'layouts.auth_master')

@php
    $bgImage = getContent('auth_background_iamge.content', true);
@endphp

@section('content')
    <div class="account-section bg_img"
         data-background="{{ getImage('assets/images/frontend/auth_background_iamge/' .@$bgImage->data_values->image, '1920x1080') }}">
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
                        <h6 class="section__title mb-0">@lang('Please Verify Your Mobile to Get Access')</h6>
                    </div>
                    <form class="account--form row g-4" method="POST" action="{{route('user.verify.mobile')}}">
                        @csrf
                        <p class="verification-text text--white">@lang('A 6 digit verification code sent to your mobile number') :
                            +{{ showMobileNumber(auth()->user()->mobileNumber) }}</p>
                        @include($activeTemplate.'partials.verification_code')
                        <div class="mb-3">
                            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                        </div>
                        <div class="form-group">
                            <p class="text--white">
                                @lang('If you don\'t get any code'), <span class="countdown-wrapper">@lang('try again after') <span
                                        id="countdown" class="fw-bold">--</span> @lang('seconds')</span> <a
                                    href="{{route('user.send.verify.code', 'sms')}}"
                                    class="try-again-link d-none"> @lang('Try again')</a>
                            </p>
                            <a href="{{ route('user.logout') }}">@lang('Logout')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var distance = Number("{{@$user->ver_code_send_at->addMinutes(2)->timestamp-time()}}");
        var x = setInterval(function () {
            distance--;
            document.getElementById("countdown").innerHTML = distance;
            if (distance <= 0) {
                clearInterval(x);
                document.querySelector('.countdown-wrapper').classList.add('d-none');
                document.querySelector('.try-again-link').classList.remove('d-none');
            }
        }, 1000);
    </script>
@endpush
@push('style')
    <style>
        .verification-code::after {
            display: none;
        }
    </style>
@endpush
