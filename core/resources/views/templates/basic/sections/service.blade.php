@php
    $services = getContent('service.element');
@endphp
    <!-- Service Section -->
<section class="service-section">
    <div class="container">
        <!-- Service Group -->
        @foreach($services as $service)
            <div class="custom-tab pt-60 pb-60">
                <div class="position-relative row g-0">
                    <div class="col-lg-6">
                        <div class="tab-area service--thumb">
                            <div class="tab-item">
                                <img src="{{ getImage('assets/images/frontend/service/' .@$service->data_values->image_one, '640x460') }}" alt="@lang('service')">
                            </div>
                            <div class="tab-item">
                                <img src="{{ getImage('assets/images/frontend/service/' .@$service->data_values->image_two, '640x460') }}" alt="@lang('service')">
                            </div>
                            <div class="tab-item">
                                <img src="{{ getImage('assets/images/frontend/service/' .@$service->data_values->image_three, '640x460') }}" alt="@lang('service')">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 bg--body d-flex flex-wrap align-items-center">
                        <div class="service-area ">
                            <div class="custom-tab-menu">
                                <ul class="tab-menu">
                                    <li class="service-item active">
                                        <div class="service-icon">
                                            <span>
                                                @php
                                                    echo @$service->data_values->icon_one;
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="service-content">
                                            <h5 class="title"> {{ __(@$service->data_values->heading_one) }} </h5>
                                            <p>
                                                {{ __(@$service->data_values->sub_heading_one) }}
                                            </p>
                                        </div>
                                    </li>
                                    <li class="service-item">
                                        <div class="service-icon">
                                            <span>
                                                @php
                                                    echo @$service->data_values->icon_two;
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="service-content">
                                            <h5 class="title"> {{ __(@$service->data_values->heading_two) }} </h5>
                                            <p>
                                                {{ __(@$service->data_values->sub_heading_two) }}
                                            </p>
                                        </div>
                                    </li>
                                    <li class="service-item">
                                        <div class="service-icon">
                                            <span>
                                                @php
                                                    echo @$service->data_values->icon_three;
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="service-content">
                                            <h5 class="title"> {{ __(@$service->data_values->heading_three) }} </h5>
                                            <p>
                                                {{ __(@$service->data_values->sub_heading_three) }}
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Service Group -->
        @endforeach
    </div>
</section>
<!-- Service Section -->
