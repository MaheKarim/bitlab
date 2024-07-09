@php
    $how_to_work = getContent('how_to_work.content', true);
    $works = getContent('how_to_work.element');
@endphp
    <!-- How Section -->
<section class="how-section pt-120 pb-120 gradient--bg bg_img bg_fixed" data-background="{{ getImage('assets/images/frontend/how_to_work/' .@$how_to_work->data_values->image, '1920x1080') }}">
    <div class="container">
        <div class="section__header section__header__center text--white">
            <span class="section__cate">{{ __(@$how_to_work->data_values->title) }}</span>
            <h3 class="section__title">{{ __(@$how_to_work->data_values->heading) }}</h3>
            <p>
                {{ __(@$how_to_work->data_values->sub_heading) }}
            </p>
        </div>
        <div class="row g-0 gy-5 justify-content-center">
            @foreach($works->reverse() as $signleWork)
                <div class="col-lg-4">
                    <div class="how__item">
                        <div class="shape-bg">
                            <img src="{{ $loop->even == true ? $activeTemplateTrue .'/css/icons/how-shape2.png' : $activeTemplateTrue .'/css/icons/how-shape.png' }}" alt="css">
                        </div>
                        <div class="how__thumb">
                            @php
                                echo $signleWork->data_values->icon;
                            @endphp
                        </div>
                        <div class="how__content">
                            <h5 class="title text--white">{{ __($signleWork->data_values->title) }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- How Section -->
