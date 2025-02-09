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
    <link href="{{ asset('assets/global/css/select2.min.css') }}" rel="stylesheet">
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
<script src="{{asset('assets/global/js/select2.min.js')}}"></script>
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
@php
    $favicon = getImage(getFilePath('logoIcon') .'/favicon.png');
@endphp
<!-- Particles Js -->
<script src="{{asset($activeTemplateTrue.'js/particles.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/particles.php?favicon='.$favicon) }}"></script>
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

        $(".langSel").on("change", function () {
            window.location.href = "{{route('home')}}/change/" + $(this).val();
        });

        $('.policy').on('click',function(){
            $.get('{{route('cookie.accept')}}', function(response){
                $('.cookies-card').addClass('d-none');
            });
        });

        setTimeout(function(){
            $('.cookies-card').removeClass('hide')
        },2000);

        var inputElements = $('[type=text],select,textarea');
        $.each(inputElements, function (index, element) {
            element = $(element);
            element.closest('.form-group').find('label').attr('for',element.attr('name'));
            element.attr('id',element.attr('name'))
        });

        $.each($('input, select, textarea'), function (i, element) {
            var elementType = $(element);
            if(elementType.attr('type') != 'checkbox'){
                if (element.hasAttribute('required')) {
                    $(element).closest('.form-group').find('label').addClass('required');
                }
            }
        });

        let disableSubmission = false;
        $('.disableSubmission').on('submit',function(e){
            if (disableSubmission) {
                e.preventDefault()
            }else{
                disableSubmission = true;
            }
        });

    })(jQuery);
</script>

@stack('script')

</body>
</html>
