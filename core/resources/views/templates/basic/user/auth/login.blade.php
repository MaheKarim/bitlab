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
                        <h4 class="section__title mb-0">@lang('Sign In')</h4>
                    </div>
                    @include($activeTemplate.'partials.social_login')
                    <form class="account--form row g-4" method="POST" action="{{ route('user.login')}}" onsubmit="return submitUserForm();">
                        @csrf
                        <div class="col-sm-12">
                            <label for="username" class="form--label-2">@lang('Username or Email')</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form--control-2" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="password" class="form--label-2">@lang('Password')</label>
                            <input id="password" type="password" class="form--control-2" name="password" required autocomplete="off">
                        </div>
                        <div class="col-sm-12">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text--white" for="remember">
                                @lang('Remember Me')
                            </label>
                        </div>
                        <div class="col-sm-12">
                            @php echo loadReCaptcha() @endphp
                        </div>
                        @include($activeTemplate.'partials.custom_captcha')

                        <div class="col-sm-12">
                            <a href="{{route('user.password.request')}}">
                                @lang('Forgot Your Password') ?
                            </a>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn w-100">@lang('Sign In')</button>
                        </div>
                    </form>
                    <div class="mt-5 text-center text--white">
                        @lang('Don\'t have an Account') ? <a href="{{ route('user.register') }}" class="text--base">@lang('Create New')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        "use strict";
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
    </script>
@endpush
