@extends($activeTemplate . 'layouts.auth_master')

@php
    $bgImage = getContent('auth_background_iamge.content', true);
    $policyPages = getContent('policy_pages.element');
@endphp

@section('content')
    @if (gs('registration'))
        <div class="account-section bg_img"
            data-background="{{ getImage('assets/images/frontend/auth_background_iamge/' . @$bgImage->data_values->image, '1920x1080') }}">
            <div class="account__section-wrapper">
                <div class="account__section-thumb">
                    <div class="logo d-none d-lg-block">
                        <a href="{{ route('home') }}">
                            <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="@lang('logo')">
                        </a>
                    </div>
                </div>
                <div class="account__section-content bg--title account__section-content-reg">
                    <div class="w-100">
                        <div class="logo mb-5 d-lg-none">
                            <a href="{{ route('home') }}">
                                <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="@lang('logo')">
                            </a>
                        </div>
                        <div class="section__header text--white">
                            <h4 class="section__title mb-0">@lang('Sign Up')</h4>
                        </div>
                        @include($activeTemplate . 'partials.social_login')

                        <form class="account--form row g-4" action="{{ route('user.register') }}" method="POST"
                            onsubmit="return submitUserForm();">
                            @csrf

                            @if (session()->get('reference') != null)
                                <div class="col-sm-12">
                                    <label for="referenceBy" class="form--label-2">@lang('Reference By')</label>
                                    <input type="text" name="referBy" id="referenceBy" class="form--control-2"
                                        value="{{ session()->get('reference') }}" readonly>
                                </div>
                            @endif

                            <div class="form-group col-sm-6">
                                <label class="form--label-2">@lang('First Name')</label>
                                <input type="text" class="form--control-2" name="firstname"
                                    value="{{ old('firstname') }}" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="form--label-2">@lang('Last Name')</label>
                                <input type="text" class="form--control-2" name="lastname" value="{{ old('lastname') }}"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form--label-2">@lang('E-Mail Address')</label>
                                    <input type="email" class="form--control-2 checkUser" name="email"
                                        value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form--label-2">@lang('Password')</label>
                                    <input type="password"
                                        class="form--control-2 @if (gs('secure_password')) secure-password @endif"
                                        name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form--label-2">@lang('Confirm Password')</label>
                                    <input type="password" class="form--control-2" name="password_confirmation" required>
                                </div>
                            </div>
                            <x-captcha />
                            <div class="col-md-12">
                                @if (gs('agree'))
                                    @php
                                        $policyPages = getContent('policy_pages.element', false, orderById: true);
                                    @endphp
                                    <div class="form-group">
                                        <input type="checkbox" class="form-check-input" id="agree"
                                            @checked(old('agree')) name="agree" required>
                                        <label class="text--white" for="agree">@lang('I agree with')</label>
                                        <span>
                                            @foreach ($policyPages as $policy)
                                                <a href="{{ route('policy.pages', $policy->slug) }}"
                                                    target="_blank">{{ __($policy->data_values->title) }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" id="recaptcha" class="btn cmn--btn w-100">
                                        @lang('Register')</button>
                                </div>
                            </div>
                            <p class="mb-0 text--white text-center">@lang('Already have an account?')
                                <a class="text--base" href="{{ route('user.login') }}">@lang('Login')</a>
                            </p>
                       </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="existModalCenter" tabindex="-1" aria-labelledby="existModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-center mt-2">@lang('You already have an account please Sign in')</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cmn--btn btn--sm btn--danger"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <a href="{{ route('user.login') }}" class="btn btn--success">@lang('Login')</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include($activeTemplate . 'partials.registration_disabled')
    @endif

@endsection
@if (gs('registration'))

    @push('style')
        <style>
            .social-login-btn {
                border: 1px solid #dddddd54 !important;
                color: #fff;
            }

            .social-login-btn:hover {
                border: 1px solid #dddddd54!important;
                color: #f2f2f2;
            }

            .auth-devide {
                text-align: center;
                margin-block: 32px;
                position: relative;
                z-index: 1;
            }

            .auth-devide span {
                font-weight: 500;
                padding-inline: 6px;
                background-color: #001933;
            }

            .auth-devide::after {
                content: "";
                position: absolute;
                height: 1px;
                width: 100%;
                background-color: #dddddd54;
                top: 50%;
                left: 0;
                z-index: -1;
            }

            .register-disable {
                height: 100vh;
                width: 100%;
                background-color: #fff;
                color: black;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .register-disable-image {
                max-width: 300px;
                width: 100%;
                margin: 0 auto 32px;
            }

            .register-disable-title {
                color: rgb(0 0 0 / 80%);
                font-size: 42px;
                margin-bottom: 18px;
                text-align: center
            }

            .register-disable-icon {
                font-size: 16px;
                background: rgb(255, 15, 15, .07);
                color: rgb(255, 15, 15, .8);
                border-radius: 3px;
                padding: 6px;
                margin-right: 4px;
            }

            .register-disable-desc {
                color: rgb(0 0 0 / 50%);
                font-size: 18px;
                max-width: 565px;
                width: 100%;
                margin: 0 auto 32px;
                text-align: center;
            }

            .register-disable-footer-link {
                color: #fff;
                background-color: #5B28FF;
                padding: 13px 24px;
                border-radius: 6px;
                text-decoration: none
            }

            .register-disable-footer-link:hover {
                background-color: #440ef4;
                color: #fff;
            }

            /* Autofill Css */
            input:-webkit-autofill,
            input:-webkit-autofill:hover,
            input:-webkit-autofill:focus,
            input:-webkit-autofill:active {
                -webkit-transition: background-color 5000s ease-in-out 0s;
                transition: background-color 5000s ease-in-out 0s;
            }

            input:-webkit-autofill,
            textarea:-webkit-autofill,
            select:-webkit-autofill {
                -webkit-box-shadow: 0 0 0px 1000px transparent inset;
                -webkit-text-fill-color: #fff !important;
                caret-color: #fff;
            }

            .form-check-input[type=checkbox] {
                border-radius: .25em;
            }

            .form-check-input {
                width: 1em;
                height: 1em;
                margin-top: .25em;
                vertical-align: top;
                background-color: #fff;
                background-repeat: no-repeat;
                background-position: center;
                background-size: contain;
                border: 1px solid rgba(0, 0, 0, .25);
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .account--form .form-check-input:checked {
                background-color: #ff6a00;
                border-color: #ff6a00;
            }
        </style>
    @endpush

    @if (gs('secure_password'))
        @push('script-lib')
            <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
        @endpush
    @endif

    @push('script')
        <script>
            "use strict";
            (function($) {

                $('.checkUser').on('focusout', function(e) {
                    var url = '{{ route('user.checkUser') }}';
                    var value = $(this).val();
                    var token = '{{ csrf_token() }}';

                    var data = {
                        email: value,
                        _token: token
                    }

                    $.post(url, data, function(response) {
                        if (response.data != false) {
                            $('#existModalCenter').modal('show');
                        }
                    });
                });
            })(jQuery);
        </script>
    @endpush

@endif
