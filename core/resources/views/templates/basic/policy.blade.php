@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="pt-120 pb-60">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @php
                    echo $policy->data_values->details;
                @endphp
            </div>
        </div>
    </div>
@endsection
