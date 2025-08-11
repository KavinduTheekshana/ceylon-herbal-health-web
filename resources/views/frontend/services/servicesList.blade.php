<!-- Page Services Start -->
<div class="page-services">
    <div class="container">
        <div class="row">
            @forelse($services as $service)
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="{{ $loop->index * 0.2 }}s">
                        <!-- Service Header Start -->
                        <div class="service-header">
                            <div class="icon-box">
                                @if($service->icon)
                                    <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}">
                                @else
                                    <img src="{{ asset('frontend/images/icon-service-item-' . (($loop->index % 8) + 1) . '.svg') }}" alt="{{ $service->title }}">
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
                            <p>{{ $service->short_description }}</p>
                        </div>
                        <!-- Service Content End -->
                    </div>
                    <!-- Service Item End -->
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No services available at the moment. Please check back later.</p>
                </div>
            @endforelse
            
            @if($services->count() > 0)
                <div class="col-lg-12">
                    <!-- Section Footer Text Start -->
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="{{ $services->count() * 0.2 }}s">
                        <p><span>Free</span>Let's make something great work together. <a href="{{ route('contact') }}">Get Free Quote</a></p>
                    </div>
                    <!-- Section Footer Text End -->
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Page Services End -->