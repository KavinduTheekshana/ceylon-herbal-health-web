@props(['limit' => 4])

@php
    use App\Models\Service;
    
    $services = Service::where('is_active', true)
        ->where('is_featured', true)
        ->orderBy('order')
        ->orderBy('title')
        ->limit($limit)
        ->get();
@endphp

@if($services->count() > 0)
    <!-- Our Services Section Start -->
    <div class="our-services">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Services</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Our Range of Traditional <span>Healing Services</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ route('services.index') }}" class="btn-default">view all services</a>
                    </div>
                    <!-- Section Button End -->
                </div>
            </div>

            <!-- Services Section -->
            <div class="row">
                @foreach ($services as $index => $service)
                    <div class="col-lg-3 col-md-6">
                        <!-- Service Item Start -->
                        <div class="service-item wow fadeInUp" @if ($index > 0) data-wow-delay="{{ $index * 0.2 }}s" @endif>
                            <!-- Service Header Start -->
                            <div class="service-header">
                                <div class="icon-box">
                                    @if($service->icon)
                                        <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}" class="w-100">
                                    @else
                                        <img src="{{ asset('frontend/images/icon-service-item-' . (($index % 8) + 1) . '.svg') }}" alt="{{ $service->title }}">
                                    @endif
                                </div>
                                <div class="service-btn">
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        <img src="{{ asset('frontend/images/arrow-white.svg') }}" alt="">
                                    </a>
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

                @if($services->count() < $limit)
                    @for($i = $services->count(); $i < $limit; $i++)
                        <div class="col-lg-3 col-md-6">
                            <!-- Service Item Placeholder Start -->
                            <div class="service-item wow fadeInUp" data-wow-delay="{{ $i * 0.2 }}s">
                                <!-- Service Header Start -->
                                <div class="service-header">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend/images/icon-service-item-' . (($i % 8) + 1) . '.svg') }}" alt="Service">
                                    </div>
                                    <div class="service-btn">
                                        <a href="{{ route('services.index') }}">
                                            <img src="{{ asset('frontend/images/arrow-white.svg') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <!-- Service Header End -->

                                <!-- Service Content Start -->
                                <div class="service-content">
                                    <h3><a href="{{ route('services.index') }}">More Services</a></h3>
                                    <p>Explore our full range of traditional healing services.</p>
                                </div>
                                <!-- Service Content End -->
                            </div>
                            <!-- Service Item Placeholder End -->
                        </div>
                    @endfor
                @endif

                <div class="col-lg-12">
                    <!-- Section Footer Text Start -->
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="{{ min($services->count(), $limit) * 0.2 + 0.2 }}s">
                        <p><span>Free Consultation</span>Experience authentic Ayurveda with a personalized approach. 
                            <a href="{{ route('appointments.create') }}">Book Your Session</a></p>
                    </div>
                    <!-- Section Footer Text End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Services Section End -->
@endif