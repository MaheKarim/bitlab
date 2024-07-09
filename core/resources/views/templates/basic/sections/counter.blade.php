@php
    $counter = getContent('counter.content', true);
    $counters = getContent('counter.element', false, null,$orderById = true);
@endphp
    <!-- Counter Section -->
<section class="counter-section mt--80 pb-60">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach($counters as $singleCounter)
                <div class="col-sm-6 col-lg-3">
                    <div class="counter__item">
                        <div class="counter__header">
                            <h4 class="title rafcounter text--base" data-counter-end="{{ (int) $singleCounter->data_values->number }}"></h4>
                            <h4 class="title text--base">
                                @if(!is_numeric(substr($singleCounter->data_values->number, -1)))
                                    {{ substr($singleCounter->data_values->number, -1) }}
                                @endif
                            </h4>
                        </div>
                        <p>
                            {{ __($singleCounter->data_values->heading) }}
                        </p>
                        <div class="icon">
                            @php
                                echo $singleCounter->data_values->icon;
                            @endphp
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Counter Section -->
