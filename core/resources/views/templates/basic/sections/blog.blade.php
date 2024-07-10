@php
    $blog = getContent('blog.content', true);

    if(request()->routeIs('home')){
        $blogs = getContent('blog.element', false, 3, false);
    }else{
        $blogs = App\Models\Frontend::where('data_keys', 'blog.element')->latest()->paginate(getPaginate(15));
    }

@endphp
    <!-- Blog Section -->
<section class="blog-section pt-120 pb-120">
    <div class="container">
        <div class="section__header section__header__center">
            <span class="section__cate">{{ __(@$blog->data_values->title) }}</span>
            <h3 class="section__title">{{ __(@$blog->data_values->heading) }}</h3>
            <p>
                {{ __(@$blog->data_values->sub_heading) }}
            </p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($blogs as $singleBlog)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="post__item">
                        <div class="post__thumb">
                            <a href="{{ route('blog.details', slug($singleBlog->data_values->title)) }}">
                                <img src="{{ getImage('assets/images/frontend/blog/' .@$singleBlog->data_values->image, '750x500') }}" alt="@lang('blog')">
                            </a>
                        </div>
                        <div class="post__content">
                            <h6 class="post__title">
                                <a href="{{ route('blog.details', slug($singleBlog->data_values->title)) }}">{{ __($singleBlog->data_values->title) }}</a>
                            </h6>
                            <div class="meta__date">
                                <div class="meta__item">
                                    <i class="las la-calendar"></i>
                                    {{ showDateTime($singleBlog->created_at, 'd M Y') }}
                                </div>
                                <div class="meta__item">
                                    <i class="las la-user"></i>
                                    @lang('Admin')
                                </div>
                            </div>
                            <a href="{{ route('blog.details', slug($singleBlog->data_values->title)) }}" class="post__read">@lang('Read More') <i class="las la-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="justify-content-center d-flex mt-5">
            @if(!request()->routeIs('home'))
                {{ $blogs->links() }}
            @endif
        </div>
    </div>
</section>
<!-- Blog Section -->
