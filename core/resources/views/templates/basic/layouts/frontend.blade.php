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
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/owl.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php') }}?color={{ gs('base_color') }}&secondColor={{ gs('secondary_color') }}">

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
        <img class="icon" src="{{ asset($activeTemplateTrue .'images/loader.png') }}" alt="images">
    </div>
</div>

@include($activeTemplate.'partials.header')

@include($activeTemplate.'partials.banner')

@yield('content')

@include($activeTemplate.'partials.footer')

<script src="{{asset('assets/global/js/jquery-3.7.1.min.js')}}"></script>

@stack('script-lib')

<script src="{{asset('assets/global/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/magnific-popup.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/nice-select.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/owl.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/rafcounter.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>

@include('partials.notify')

@php
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp
@if(($cookie->data_values->status == Status::ENABLE) && !\Cookie::get('gdpr_cookie'))
    <!-- cookies dark version start -->
    <div class="cookies-card text-center hide">
        <div class="cookies-card__icon bg--base">
            <i class="las la-cookie-bite"></i>
        </div>
        <p class="mt-4 cookies-card__content">{{ $cookie->data_values->short_desc }} <a href="{{ route('cookie.policy') }}" target="_blank">@lang('learn more')</a></p>
        <div class="cookies-card__btn mt-4">
            <a href="javascript:void(0)" class="btn btn--base w-100 policy">@lang('Allow')</a>
        </div>
    </div>
    <!-- cookies dark version end -->
@endif

<!-- Particles Js -->
<script src="{{asset($activeTemplateTrue.'js/particles.min.js')}}"></script>
{{--<script src="{{asset($activeTemplateTrue.'js/particles.php?favicon='.$favicon) }}"></script>--}}
<!-- Particles Js -->

<script>
    (function($){
        "use strict";
        let navLink = $('.menu a');
        let currentRoute = '{{ url()->current() }}';

        $.each(navLink, function(index, value) {
            if(value.href == currentRoute){
                $(value).addClass('active');
            }
        });

        $('.cookie-btn').on('click', function(){
            $.ajax({
                method:'get',
                url:'{{ route("cookie.accept") }}',
                success:function(response){
                    if(response.success){
                        $('.cookie-policy').remove();
                        notify('success', response.message);
                    }
                }
            });
        });

    })(jQuery);
</script>

@stack('script')

</body>
</html>
