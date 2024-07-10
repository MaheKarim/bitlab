@php
    $banner = getContent('banner.content', true);
@endphp

@if(request()->routeIs('home'))
    <!-- Banner -->
    <section class="banner-section pt-120 pb-120 bg_img" data-background="{{ getImage('assets/images/frontend/banner/' .@$banner->data_values->image, '1920x1080') }}">
        <div class="container">
            <div class="banner__wrapper justify-content-center">
                <div class="banner__content text-center">
                    <h2 class="banner__content-title">{{ __(@$banner->data_values->heading) }}</h2>
                    <p class="banner__content-txt">
                        {{ __(@$banner->data_values->sub_heading) }}
                    </p>
                    <div class="btn__grp">
                        <a href="{{ @$banner->data_values->button_url }}" class="cmn--btn">{{ __(@$banner->data_values->button_text) }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner__thumb">
            <img src="{{ getImage('assets/images/frontend/banner/' .@$banner->data_values->thumb_image, '400x315') }}" alt="banner">
        </div>
        <div class="particles-js" id="particles-js"></div>
    </section>
    <!-- Banner -->
@else
    @if(!gs('maintenance_mode'))
        <div class="hero-section gradient--bg bg_img {{ request()->routeIs('about') ? 'hero-about' : null }}" data-background="{{ getImage('assets/images/frontend/banner/' .@$banner->data_values->image, '1920x1080') }}">
            <div class="container">
                <div class="hero-content">
                    <h3 class="title text--white">{{ __(@$pageTitle) }}</h3>
                </div>
            </div>
            <div class="particles-js" id="particles-js"></div>
        </div>
    @endif
@endif
