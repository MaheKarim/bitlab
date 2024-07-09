@extends($activeTemplate.'layouts.frontend')

@section('content')
    <!-- Blog Single Section -->
    <section class="blog-section pt-120 pb-120">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="post__details pb-50">
                        <div class="post__header">
                            <h3 class="post__title">
                                {{ __($blog->data_values->title) }}
                            </h3>
                        </div>
                        <div class="post__thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/' .@$blog->data_values->image, '750x500') }}" alt="@lang('blog')">
                        </div>
                        <p>
                            @php
                                echo $blog->data_values->description;
                            @endphp
                        </p>
                        <div class="row gy-4 justify-content-between">
                            <div class="col-md-6">
                                <h6 class="post__share__title">@lang('Share now')</h6>
                                <ul class="post__share">
                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?=u{{ url()->current() }}" target="_blank">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/home?status={{ url()->current() }}" target="_blank">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank">
                                            <i class="lab la-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.reddit.com/submit?url={{ url()->current() }}" target="_blank">
                                            <i class="lab la-reddit"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="blog-sidebar bg--section">
                        <div class="widget widget__post__area">
                            <h5 class="widget__title">@lang('Recent Post')</h5>
                            <ul>
                                @foreach($latestBlogs as $latestBlog)
                                    <li>
                                        <a href="{{ route('blog.details', ['slug'=>slug($latestBlog->data_values->title), 'id'=>$latestBlog->id]) }}" class="widget__post">
                                            <div class="widget__post__thumb">
                                                <img src="{{ getImage('assets/images/frontend/blog/' .@$latestBlog->data_values->image, '750x500') }}" alt="blog">
                                            </div>
                                            <div class="widget__post__content">
                                                <h6 class="widget__post__title">
                                                    {{ __($latestBlog->data_values->title) }}
                                                </h6>
                                                <span>{{ showDateTime($latestBlog->created_at, 'd M Y') }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Single Section -->
@endsection

@push('fbComment')
    @php echo loadFbComment() @endphp
@endpush

@push('share')
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $blog->data_values->title }}">
    <meta property="og:image" content="{{ getImage('assets/images/frontend/blog/' .@$blog->data_values->image, '750x500') }}"/>
    <meta property="og:image:type" content="image/{{ pathinfo(getImage('assets/images/frontend/blog/') .'/'. @$blog->data_values->image)['extension'] }}" />
    @php $social_image_size = explode('x', '750x500') @endphp
    <meta property="og:image:width" content="{{ $social_image_size[0] }}" />
    <meta property="og:image:height" content="{{ $social_image_size[1] }}" />
@endpush
