@php
    $top_user = getContent('top_user.content', true);
    $tops = getContent('top_user.element');
@endphp
    <!-- Top User Section -->
<section class="top-user pt-120 pb-60">
    <div class="container">
        <div class="section__header section__header__center">
            <span class="section__cate">{{ __(@$top_user->data_values->title) }}</span>
            <h3 class="section__title">{{ __(@$top_user->data_values->heading) }}</h3>
            <p>
                {{ __(@$top_user->data_values->sub_heading) }}
            </p>
        </div>
        <div class="row justify-content-center g-4">

            @foreach($tops as $top)
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="user__item">
                        <div class="user__content">
                            <h6 class="title">{{ __($top->data_values->name) }}</h6>
                            <span class="amount">{{ __($top->data_values->transaction_amount) }}</span>
                        </div>
                        <div class="user__thumb">
                            <img src="{{ getImage('assets/images/frontend/top_user/' .@$top->data_values->image, '460x530') }}" alt="@lang('user')">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Top User Section -->
