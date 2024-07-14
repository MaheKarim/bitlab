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
        <img class="icon" src="{{ asset($activeTemplateTrue .'images/loader.png') }}" alt="images">
    </div>
</div>

@yield('content')

<script src="{{asset('assets/global/js/jquery-3.7.1.min.js')}}"></script>

@stack('script-lib')

<script src="{{asset('assets/global/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/magnific-popup.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/rafcounter.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/owl.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/nice-select.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>


@include('partials.notify')

@stack('script')

</body>
</html>
