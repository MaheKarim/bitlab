@extends($activeTemplate .'layouts.frontend')
@section('content')
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-6 p-4">
                <h3 class="text-center text--danger">@lang('You are banned!')</h3>
                <p class="fw-bold mb-1">@lang('Reason'):</p>
                <p>{{ $user->ban_reason }}</p>
            </div>
        </div>
    </div>
@endsection
