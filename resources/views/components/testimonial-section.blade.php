@props(['limit' => 2, 'featured' => true])

@php
    use App\Models\Testimonial;
    
    $query = Testimonial::with('service')
        ->active()
        ->ordered();
    
    if ($featured) {
        $query->featured();
    }
    
    $testimonials = $query->limit($limit)->get();
@endphp

@if($testimonials->count() > 0)
    <!-- Our Testimonials Section Start -->
    <div class="our-testimonials">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="testimonial-image-content">
                        <div class="testimonial-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('frontend/images/testimonial-image.jpg') }}" alt="">
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="our-testimonial-content">
                        <div class="section-title">
                            <h3>testimonials</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">
                                Real stories of transformation <span>and growth</span>
                            </h2>
                        </div>

                        @if($testimonials->count() > 1)
                            <!-- Swiper Start -->
                            <div class="swiper our-testimonial-box">
                                <div class="swiper-wrapper">
                                    @foreach($testimonials as $testimonial)
                                        <div class="swiper-slide testimonial-item">
                                            <div class="testimonial-author">
                                                <div class="author-image">
                                                    <figure class="image-anime">
                                                        @if($testimonial->client_image)
                                                            <img src="{{ asset('storage/' . $testimonial->client_image) }}" alt="{{ $testimonial->client_name }}">
                                                        @else
                                                            <img src="{{ asset('frontend/images/scrolling-ticker-image-' . (($loop->index % 6) + 1) . '.jpg') }}" alt="{{ $testimonial->client_name }}">
                                                        @endif
                                                    </figure>
                                                </div>
                                                <div class="author-content">
                                                    <h3>{{ $testimonial->client_name }}</h3>
                                                    <p>{{ $testimonial->client_title ?: 'Client' }}</p>
                                                </div>
                                            </div>
                                            <div class="testimonial-item-content">
                                                <p>{{ $testimonial->content }}</p>
                                            </div>
                                            <div class="testimonial-rating">
                                                @foreach($testimonial->rating_stars as $star)
                                                    @if($star === 'full')
                                                        <i class="fa-solid fa-star"></i>
                                                    @elseif($star === 'half')
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                    @else
                                                        <i class="fa-regular fa-star"></i>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Pagination & Nav -->
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                            <!-- Swiper End -->
                        @else
                            <!-- Single testimonial without swiper -->
                            <div class="our-testimonial-box">
                                @foreach($testimonials as $testimonial)
                                    <div class="testimonial-item">
                                        <div class="testimonial-author">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    @if($testimonial->client_image)
                                                        <img src="{{ asset('storage/' . $testimonial->client_image) }}" alt="{{ $testimonial->client_name }}">
                                                    @else
                                                        <img src="{{ asset('frontend/images/scrolling-ticker-image-1.jpg') }}" alt="{{ $testimonial->client_name }}">
                                                    @endif
                                                </figure>
                                            </div>
                                            <div class="author-content">
                                                <h3>{{ $testimonial->client_name }}</h3>
                                                <p>{{ $testimonial->client_title ?: 'Client' }}</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-item-content">
                                            <p>{{ $testimonial->content }}</p>
                                        </div>
                                        <div class="testimonial-rating">
                                            @foreach($testimonial->rating_stars as $star)
                                                @if($star === 'full')
                                                    <i class="fa-solid fa-star"></i>
                                                @elseif($star === 'half')
                                                    <i class="fa-solid fa-star-half-stroke"></i>
                                                @else
                                                    <i class="fa-regular fa-star"></i>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Testimonial Section End -->
@endif