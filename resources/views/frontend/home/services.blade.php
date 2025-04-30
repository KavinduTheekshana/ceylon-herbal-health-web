<!-- Our Services Section Start -->
<div class="our-services">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Services</h3>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Our Range of Traditional <span>Healing
                            Services</span></h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-6">
                <!-- Section Button Start -->
                <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                    <a href="services.html" class="btn-default">view all services</a>
                </div>
                <!-- Section Button End -->
            </div>
        </div>

        <!-- Services Section -->
        <div class="row">
            @foreach ($services as $index => $service)
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp"
                        @if ($index > 0) data-wow-delay="{{ $index * 0.2 }}s" @endif>
                        <!-- Service Header Start -->
                        <div class="service-header">
                            <div class="icon-box">
                                <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}"
                                    class="w-100">
                            </div>
                            <div class="service-btn">
                                <a href="{{ route('services.show', $service->slug) }}"><img
                                        src="{{ asset('frontend/images/arrow-white.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <!-- Service Header End -->

                        <!-- Service Content Start -->
                        <div class="service-content">
                            <h3><a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a></h3>
                            <p>{{ Str::limit($service->short_description, 100) }}</p>
                        </div>
                        <!-- Service Content End -->
                    </div>
                    <!-- Service Item End -->
                </div>
            @endforeach

            <div class="col-lg-12">
                <!-- Section Footer Text Start -->
                <div class="section-footer-text wow fadeInUp" data-wow-delay="0.2s">
                    <p><span>Free Consultation</span>Experience authentic Ayurveda with a personalized approach. <a
                            href="">Book Your Session</a></p>

                <!-- Section Footer Text End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Services Section End -->
