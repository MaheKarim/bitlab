<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> {{ gs()->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')

    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/animate.css')}}">
    <link href="{{asset('assets/global/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/owl.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">

    <link rel="stylesheet"
          href="{{ asset($activeTemplateTrue.'css/color.php') }}?color={{ gs('base_color') }}&secondColor={{ gs('secondary_color') }}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom.css')}}">

    @stack('style-lib')
    @stack('style')

</head>

<body>

@stack('fbComment')

<div class="overlay"></div>
<a href="#0" class="scrollToTop"><i class="las la-angle-up"></i></a>

<div class="preloader">
    <div id="preloader">
        <img class="icon" src="{{ asset($activeTemplateTrue .'images/loader.png') }}" alt="@lang('images')">
    </div>
</div>

@include($activeTemplate.'partials.header')

@include($activeTemplate.'partials.banner')

@php
    $user = Auth::user();
@endphp

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="dashboard-menu-open d-xl-none">
            <i class="las la-ellipsis-v"></i>
        </div>
        <div class="row">

            <div class="col-xl-3">
                <div class="dashboard-menu">
                    <div class="user">
                        <span class="side-sidebar-close-btn"><i class="las la-times"></i></span>
                        <div class="thumb">
                            <a href="{{ route('user.profile.setting') }}">
                                @if($user->image)
                                    <img
                                        src="{{ getImage(getFilePath('userProfile').'/'. $user->image,getFilePath('userProfile')) }}"
                                        alt="@lang('user')">
                                @else
                                    <img src="{{ asset($activeTemplateTrue.'images/default.png') }}"
                                         alt="@lang('user')">
                                @endif
                            </a>
                        </div>
                        <div class="content">
                            <h6 class="title">
                                <a href="{{ route('user.profile.setting') }}">{{ __($user->fullname) }}</a>
                                <p class="mt-2">1 {{ __(gs('cur_text')) }}
                                    = {{ getAmount(gs('usd_rate'), 2) }} @lang('USD')</p>
                            </h6>
                        </div>
                    </div>
                    <div class="main-menu">
                        <ul>
                            <li>
                                <a href="{{ route('user.home') }}"><i class="las la-home"></i>@lang('Dashboard')</a>
                            </li>
                            <li>
                                <a href="{{ route('user.wallet') }}"><i class="las la-wallet"></i>@lang('Wallet')</a>
                            </li>
                            <li>
                                <a href="{{ route('user.send.page') }}"><i
                                        class="las la-money-bill-wave"></i>@lang('Send')</a>
                            </li>
                            <li>
                                <a href="{{ route('user.transactions') }}"><i
                                        class="las la-exchange-alt"></i>@lang('Transactions')</a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile.setting') }}"><i
                                        class="las la-user"></i>@lang('Profile')</a>
                            </li>
                            <li>
                                <a href="{{ route('user.change.password') }}"><i
                                        class="las la-key"></i>@lang('Change Password')</a>
                            </li>
                            <li>
                                <a href="{{ route('user.twofactor') }}"><i
                                        class="las la-shield-alt"></i>@lang('Security')</a>
                            </li>
                            <li>
                                <a href="{{ route('ticket.open') }}"><i class="las la-ticket-alt"></i>@lang('Support Ticket')</a>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}"><i class="las la-sign-out-alt"></i>@lang('Logout')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            @yield('content')

        </div>
    </div>
</div>

@include($activeTemplate.'partials.footer')

<script src="{{asset('assets/global/js/jquery-3.7.1.min.js')}}"></script>

@stack('script-lib')

<script src="{{asset('assets/global/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/magnific-popup.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/rafcounter.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/owl.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/nice-select.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>

@include('partials.notify')

@php
    $favicon = getImage(getFilePath('logoIcon') .'/favicon.png');
@endphp

    <!-- Particles Js -->
<script src="{{asset($activeTemplateTrue.'js/particles.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/particles.php?favicon='.$favicon) }}"></script>
<!-- Particles Js -->

<script>
    (function ($) {
        "use strict";

        let navLink = $('.main-menu li a');
        let currentRoute = '{{ url()->current() }}';

        $.each(navLink, function (index, value) {
            if (value.href == currentRoute) {
                $(value).addClass('active');
            }
        });

    })(jQuery);
</script>

@stack('script')

</body>
</html>
