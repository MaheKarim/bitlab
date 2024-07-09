@php
    $cryptoPrices = getContent('crypto_price.element');
@endphp
    <!-- Crypto Price -->
<div class="crypto-price-section d-none">
    <div class="container">
        <div class="row g-3 g-md-4">
            @foreach($cryptoPrices as $price)
                <div class="col-lg-3 col-sm-6">
                    <div class="crp__item">
                        <div class="crp__top">
                            <div class="thumb">
                                <img src="{{ getImage('assets/images/frontend/crypto_price/' .@$price->data_values->image, '95x95') }}" alt="currency">
                            </div>
                        </div>
                        <h6 class="subtitle">{{ __($price->data_values->currency) }}</h6>
                        <span class="price">{{ __($price->data_values->price) }}</span>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Crypto Price -->
