@extends($activeTemplate.'layouts.frontend')

@php
    $contact = getContent('contact_us.content', true);
@endphp

@section('content')
    <!-- Contact Section -->
    <section class="contact-section pt-120 pb-60">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="bg--section p-4">
                        <div class="section__header mb-0">
                            <h3 class="section__title">{{ __(@$contact->data_values->title) }}</h3>
                            <div class="section__shape">
                                <div
                                    class="progress-bar progress-bar-striped bg--base progress-bar-animated w-100"></div>
                            </div>
                        </div>
                        <form class="contact-form row g-4" action="" method="post">
                            @csrf
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="form--label">@lang('Name')</label>
                                    <input type="text" class="form-control form--control h-50px" id="name" name="name"
                                           value="@if(auth()->user()) {{ auth()->user()->fullname }} @else {{ old('name') }} @endif"
                                           @if(auth()->user()) readonly @endif required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="form--label">@lang('Email')</label>
                                    <input type="email" class="form-control form--control h-50px" id="email"
                                           name="email"
                                           value="@if(auth()->user()) {{ auth()->user()->email }} @else {{old('email')}} @endif"
                                           @if(auth()->user()) readonly @endif required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="subject" class="form--label">@lang('Subject')</label>
                                    <input type="text" class="form-control form--control h-50px" id="subject"
                                           name="subject">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="message" class="form--label">@lang('Your Message')</label>
                                    <textarea name="message" id="message" class="form-control form--control"
                                              name="message">{{old('message')}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group m-0 pt-3">
                                    <button type="submit"
                                            class="cmn--btn">{{ __(@$contact->data_values->button_text) }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact__wrapper__2_inner bg--section p-4">
                        <div class="maps rounded">
                            <iframe src="{{ __(@$contact->data_values->map_source) }}" allowfullscreen=""
                                    loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section -->

    <!-- Contact Info Section Starts Here -->
    <section class="contact-section pt-60 pb-60">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="contact__item bg--section">
                        <div class="contact__icon">
                            <i class="las la-phone"></i>
                        </div>
                        <div class="contact__body">
                            <h6 class="contact__title">@lang('Phone')</h6>
                            <ul class="contact__info">
                                <li>
                                    <a href="Tel:{{ @$contact->data_values->phone }}">{{ @$contact->data_values->phone }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact__item bg--section">
                        <div class="contact__icon">
                            <i class="las la-envelope"></i>
                        </div>
                        <div class="contact__body">
                            <h6 class="contact__title">@lang('Email')</h6>
                            <ul class="contact__info">
                                <li>
                                    <a href="mailto:{{ @$contact->data_values->email }}">{{ @$contact->data_values->email }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact__item bg--section">
                        <div class="contact__icon">
                            <i class="las la-map-marker"></i>
                        </div>
                        <div class="contact__body">
                            <h6 class="contact__title">@lang('Address')</h6>
                            <ul class="contact__info">
                                <li>
                                    <a href="javascript:void(0)">{{ __(@$contact->data_values->address) }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Info Section Ends Here -->

    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif

@endsection
