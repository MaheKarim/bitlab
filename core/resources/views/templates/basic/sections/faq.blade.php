@php
    $faq = getContent('faq.content', true);
    $faqs = getContent('faq.element');
@endphp
    <!-- Faqs Section -->
<section class="faqs-section pt-60 pb-120 overflow-hidden">
    <div class="container">
        <div class="section__header section__header__center">
            <span class="section__cate">{{ __(@$faq->data_values->title) }}</span>
            <h3 class="section__title">{{ __(@$faq->data_values->heading) }}</h3>
            <p>
                {{ __(@$faq->data_values->sub_heading) }}
            </p>
        </div>
        <div class="row gy-5">
            <div class="col-lg-6">
                <div class="faq--thumb rtl">
                    <img src="{{ getImage('assets/images/frontend/faq/' .@$faq->data_values->image, '770x800') }}" alt="faq">
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="faq__wrapper px-lg-4 ps-xl-5">
                    @foreach($faqs as $singleFaq)
                        <div class="faq__item {{ $loop->index == 1 ? 'open active' : null }}">
                            <div class="faq__title">
                                <h6 class="title">
                                    {{ __($singleFaq->data_values->question) }}
                                </h6>
                                <span class="right--icon"></span>
                            </div>
                            <div class="faq__content">
                                <p>
                                    <span>
                                        @php
                                            echo $singleFaq->data_values->answer;
                                        @endphp
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Faqs Section -->
