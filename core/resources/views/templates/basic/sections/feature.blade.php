@php
    $features = getContent('feature.element');
    $feature = getContent('feature.content', true);
@endphp
    <!-- Feature Section -->
<section class="feature-section pt-60 pb-120 {{ request()->routeIs('about') ? 'hero-about mt--80 pt-0' : null }}">
    <div class="container">
        <div class="row justify-content-center g-4">
            @foreach($features as $feature)
                <div class="col-xl-4 col-md-6">
                    <div class="feature-item">
                        <div class="icon">
                            @php
                                echo @$feature->data_values->icon;
                            @endphp
                        </div>
                        <div class="cont">
                            <h6 class="subtitle">{{ __(@$feature->data_values->heading) }}</h6>
                            <p>
                                {{ __(@$feature->data_values->sub_heading) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Feature Section -->
