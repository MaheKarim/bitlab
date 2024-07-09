@php
    $footer = getContent('footer.content', true);
    $policyPages = getContent('policy_pages.element', false, null, true);
    $socialLinks = getContent('social_link.element', false, null, true);
@endphp
    <!-- Footer Section -->
<footer class="footer-section bg--section">
    <div class="container">
        <div class="footer-top">
            <div class="footer-wrapper">
                <div class="footer-widget widget-links">
                    <h5 class="title">@lang('About')</h5>
                    <p>{{ __(@$footer->data_values->about) }}</p>
                </div>
                <div class="footer-widget widget-links">
                    <h5 class="title">@lang('Page')</h5>
                    <ul class="links">
                        @foreach($pages as $k => $data)
                            <li>
                                <a href="{{route('pages',[$data->slug])}}">
                                    {{__($data->name)}}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('blogs') }}">@lang('Blog')</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">@lang('Contact')</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-widget widget-links">
                    <h5 class="title">@lang('Useful Link')</h5>
                    <ul class="links">
{{--                        @foreach($policyPages as $singlePolicy)--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('policy.details', ['policy'=>slug($singlePolicy->data_values->title)]) }}">{{ __($singlePolicy->data_values->title) }}</a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
                    </ul>
                </div>
                <div class="footer-widget widget-links">
                    <h5 class="title">@lang('Social Links')</h5>
                    <ul class="links">
                        @foreach($socialLinks as $singleLink)
                            <li>
                                <a href="{{ $singleLink->data_values->social_url }}" target="_blank">{{ __($singleLink->data_values->social_name) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-middle">
        <div class="container">
            <div class="footer-middle-wrapper">
                <div class="logo">
                    <a href="{{ route('home') }}"><img src="{{getImage(getFilePath('logoIcon'))}}" alt="@lang('logo')"></a>
                </div>
                <div class="cont text-white">
                    {{ __(@$footer->data_values->website_footer) }}
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section -->
