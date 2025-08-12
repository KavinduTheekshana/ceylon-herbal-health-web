<!-- Page Testimonials Start -->
<div class="page-testimonials">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="our-testimonial-box">
                    @forelse($testimonials as $testimonial)
                        <!-- Testimonial Item Start -->
                        <div class="testimonial-item wow fadeInUp" data-wow-delay="{{ $loop->index * 0.2 }}s">
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
                                    <h3>{{ strtolower($testimonial->client_name) }}</h3>
                                    <p>{{ strtolower($testimonial->client_title ?: 'Client') }}</p>
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
                        <!-- Testimonial Item End -->
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <h3>No testimonials available yet</h3>
                                <p>Check back soon to read what our clients say about us!</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Testimonials End -->