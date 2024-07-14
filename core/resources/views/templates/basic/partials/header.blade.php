@php
    $links = getContent('social_link.element', false, null, true);
    $address = getContent('social_link.content', true);
    $header = getContent('header.content', true);
@endphp
    <!-- Header Section -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <ul class="header-top-area">
                <li class="me-auto">
                    <ul class="social">
                        @foreach($links as $socialLink)
                            <li>
                                <a href="{{ $socialLink->data_values->social_url }}" target="_blank">
                                    @php
                                        echo $socialLink->data_values->icon;
                                    @endphp
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="mail">
                    <i class="las la-phone-alt"></i>
                    <a href="Tel:{{ @$header->data_values->mobile }}">{{ __(@$header->data_values->mobile) }}</a>
                </li>
                <li class="mail">
                    <i class="las la-envelope"></i>
                    <a href="Mailto:{{ @$header->data_values->email }}">{{ __(@$header->data_values->email) }}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="{{ route('home') }}"><img src="{{ getImage(getFilePath('logoIcon') . '/logo.png')}}" alt="@lang('logo')">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="{{ route('home') }}">@lang('Home')</a>
                    </li>
                    @foreach($pages as $k => $data)
                        <li>
                            <a href="{{route('pages',[$data->slug])}}">
                                {{__($data->name)}}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('blogs') }}">@lang('Blog')</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>
                    <li class="d-md-none">
                        @if(Auth::user())
                            <a href="{{ route('user.home') }}" class="cmn--btn py-0 m-1">@lang('Dashboard')</a>
                        @else
                            <a href="{{ route('user.login') }}" class="cmn--btn py-0 m-1">@lang('Sign in')</a>
                        @endif
                    </li>
                </ul>
                <div class="d-flex flex-wrap align-items-center justify-content-end ms-lg-0 ms-auto">
                    <div class="header-lang">
                        {{-- <select class="langSel">
                            @foreach($language as $item)
                                <option value="{{$item->code}}" @if(session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>
                            @endforeach
                        </select> --}}
                        <div class="custom--dropdown">
                            <div class="custom--dropdown__selected dropdown-list__item">
                                <div class="thumb">
                                    <img src="https://script.viserlab.com/visertrade/assets/images/language/66535f59bd4c91716739929.png"
                                        alt="img">
                                </div>
                                <span class="text"> English </span>
                            </div>
                            <ul class="dropdown-list">
                                <li class="dropdown-list__item " data-value="en">
                                    <a href="https://script.viserlab.com/visertrade/change/en" class="thumb">
                                        <img src="https://script.viserlab.com/visertrade/assets/images/language/66535f59bd4c91716739929.png"
                                            alt="image">
                                    </a>
                                    <span class="text"> English </span>
                                </li>
                                <li class="dropdown-list__item " data-value="hi">
                                    <a href="https://script.viserlab.com/visertrade/change/hi" class="thumb">
                                        <img src="https://script.viserlab.com/visertrade/assets/images/language/66535f47d108b1716739911.png"
                                            alt="image">
                                    </a>
                                    <span class="text"> Hindi </span>
                                </li>
                                <li class="dropdown-list__item " data-value="bn">
                                    <a href="https://script.viserlab.com/visertrade/change/bn" class="thumb">
                                        <img src="https://script.viserlab.com/visertrade/assets/images/language/66535f22aab011716739874.png"
                                            alt="image">
                                    </a>
                                    <span class="text"> Bangla </span>
                                </li>
                                <li class="dropdown-list__item " data-value="es">
                                    <a href="https://script.viserlab.com/visertrade/change/es" class="thumb">
                                        <img src="https://script.viserlab.com/visertrade/assets/images/language/66535f3320a351716739891.png"
                                            alt="image">
                                    </a>
                                    <span class="text"> Spanish </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="right-area d-none d-md-flex">
                        @if(Auth::user())
                            <a href="{{ route('user.home') }}" class="cmn--btn py-0 m-1">@lang('Dashboard')</a>
                        @else
                            <a href="{{ route('user.login') }}" class="cmn--btn py-0 m-1">@lang('Sign in')</a>
                        @endif
                    </div>
                </div>
                <div class="header-bar ms-3 me-0">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Section -->

@push('script')
    <script>
        $(document).ready(function(){
            "use strict";

            $(".langSel").on("change", function() {
                window.location.href = "{{route('home')}}/change/"+$(this).val() ;
            });

        });
    </script>
@endpush
