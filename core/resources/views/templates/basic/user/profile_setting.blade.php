@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="col-xl-9">
        <div class="profile-area">
            <div class="row">
                <div class="col-lg-4">
                    <div class="user-profile">
                        <div class="thumb">
                            @if($user->image)
                                <img src="{{ getImage(getFilePath('userProfile').'/'. $user->image,getFilePath('userProfile')) }}" alt="@lang('user')">
                            @else
                                <img src="{{ asset($activeTemplateTrue.'images/default.png') }}" alt="@lang('user')">
                            @endif
                        </div>
                        <div class="remove-image">
                            <i class="las la-times"></i>
                        </div>
                        <div class="content">
                            <h5 class="title">{{ __($user->fullname) }}</h5>
                            <span>@lang('Username'): {{ __($user->username) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form class="user-profile-form row mb--20 prevent-double-click" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6 mb-20">
                            <label for="firstname" class="form--label">@lang('First Name')</label>
                            <input class="form-control form--control" id="firstname" type="text" name="firstname" value="{{$user->firstname}}" minlength="3" required>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="lastname" class="form--label">@lang('Last Name')</label>
                            <input class="form-control form--control" id="lastname" type="text" name="lastname" value="{{$user->lastname}}" required>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="email" class="form--label">@lang('Email Address')</label>
                            <input class="form-control form--control" id="email" name="email" type="text" value="{{$user->email}}" readonly>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="phone" class="form--label">@lang('Mobile')</label>
                            <input class="form-control form--control" id="phone" name="phone" type="text" value="{{$user->mobile}}" readonly>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="address" class="form--label">@lang('Address')</label>
                            <input class="form-control form--control" id="address" name="address" type="text" value="{{@$user->address}}" required="">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="state" class="form--label">@lang('State')</label>
                            <input class="form-control form--control" id="state" name="state" type="text" value="{{@$user->state}}" required="">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="zip" class="form--label">@lang('Zip Code')</label>
                            <input class="form-control form--control" id="zip" name="zip" type="text" value="{{@$user->zip}}" required="">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="city" class="form--label">@lang('City')</label>
                            <input class="form-control form--control" id="city" name="city" type="text" value="{{@$user->city}}" required="">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="country" class="form--label">@lang('Country')</label>
                            <input class="form-control form--control" id="country" name="country" type="text" value="{{@$user->country}}" readonly>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="image" class="form--label">@lang('Change Image')</label>
                            <input type="file" name="image" accept="image/*" class="form-control form--control" id="image">
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="cmn--btn w-unset">@lang('Update Profile')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link href="{{ asset($activeTemplateTrue.'css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endpush

@push('style')
    <link rel="stylesheet" href="{{asset('assets/admin/build/css/intlTelInput.css')}}">
    <style>
        .intl-tel-input {
            position: relative;
            display: inline-block;
            width: 100%;!important;
        }
    </style>
@endpush
