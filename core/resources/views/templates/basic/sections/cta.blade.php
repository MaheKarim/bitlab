@php
    $cta = getContent('cta.content', true);
@endphp
    <!-- CTAs Section -->
<section class="cta-section gradient--bg bg_img bg_fixed" data-background="{{ getImage('assets/images/frontend/cta/' .@$cta->data_values->image, '1920x1080') }}">
    <div class="container">
        <div class="cta-wrapper">
            <div class="section__header section__header__center text--white mb-5">
                <h3 class="section__title mt-0"> {{ __(@$cta->data_values->heading) }} </h3>
                <p>
                    {{ __(@$cta->data_values->sub_heading) }}
                </p>
            </div>
            <a href="{{ @$cta->data_values->button_url }}" class="cmn--btn text--white"> {{ __(@$cta->data_values->button_text) }} </a>
        </div>
    </div>
</section>
<!-- CTAs Section -->
