@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="col-xl-9">
        <div class="change-wrapper">
            <form method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label" class="required">@lang('Current Password')</label>
                    <input type="password" class="form-control form--control" name="current_password" required
                           autocomplete="current-password">
                </div>
                <div class="form-group">
                    <label class="form-label mt-2">@lang('Password')</label>
                    <input type="password"
                           class="form-control form--control @if(gs('secure_password')) secure-password @endif"
                           name="password" required autocomplete="current-password">
                </div>
                <div class="form-group">
                    <label class="form-label mt-2">@lang('Confirm Password')</label>
                    <input type="password" class="form-control form--control" name="password_confirmation" required
                           autocomplete="current-password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn--base w-100 mt-4">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@if(gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
