@php
    $sponsors = getContent('sponsor.element');
@endphp
    <!-- Sponsor Section -->
<div class="sponsor-section pt-0">
    <div class="container">
        <div class="sponsor-slider owl-theme owl-carousel">
            @foreach($sponsors as $singleSponsor)
                <div class="sponsor-item bg--section">
                    <img src="{{ getImage('assets/images/frontend/sponsor/' .@$singleSponsor->data_values->image, '140x150') }}" alt="sponsor">
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Sponsor Section -->
