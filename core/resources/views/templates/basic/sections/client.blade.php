@php
    $client = getContent('client.content', true);
    $clients = getContent('client.element');
@endphp
    <!-- Clients Section -->
<section class="clients-section pt-60">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-7 col-xl-6 align-self-end">
                <div class="client-thumb">
                    <img src="{{ getImage('assets/images/frontend/client/' .@$client->data_values->image, '985x700') }}" alt="@lang('client')">
                </div>
            </div>
            <div class="col-lg-5 align-self-center">
                <div class="pt-max-lg-0 pt-60 pb-120">
                    <div class="section__header">
                        <span class="section__cate">{{ __(@$client->data_values->title) }}</span>
                        <h3 class="section__title">{{ __(@$client->data_values->heading) }}</h3>
                        <p>
                            {{ __(@$client->data_values->sub_heading) }}
                        </p>
                    </div>
                    <div class="client-slider owl-theme owl-carousel">
                        @foreach($clients as $singleClient)
                            <div class="client__item">
                                <blockquote>
                                    {{ __(@$singleClient->data_values->say) }}
                                </blockquote>
                                <div class="author">
                                    <h6 class="title">{{ __(@$singleClient->data_values->name) }}</h6>
                                    <span class="text--base">{{ __(@$singleClient->data_values->designation) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Clients Section -->
