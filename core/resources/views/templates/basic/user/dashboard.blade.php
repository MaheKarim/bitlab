@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="notice"></div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __($pageTitle) }}</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum sunt ducimus laboriosam commodi nesciunt accusamus? Sunt in, minus ex, a eveniet inventore facilis doloribus placeat corrupti repudiandae sint esse nesciunt.
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum unde, vitae esse eum perspiciatis consectetur nisi, atque repellendus, cumque magnam ab a inventore quis nobis quod quisquam omnis. In, possimus!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
