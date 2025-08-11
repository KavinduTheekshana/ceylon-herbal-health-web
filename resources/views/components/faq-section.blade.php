@props(['limit' => 5, 'categoryId' => null])

@php
    use App\Models\Faq;
    use App\Models\FaqCategory;
    
    $query = Faq::where('is_active', true)
        ->with('category')
        ->orderBy('order')
        ->orderBy('id');
    
    if ($categoryId) {
        $query->where('faq_category_id', $categoryId);
    }
    
    $faqs = $query->limit($limit)->get();
@endphp

@if($faqs->count() > 0)
    <!-- Our Faqs Section Start -->
    <div class="our-faqs">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">FAQs</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Got questions? We're here to help you <span>feel confident.</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Button Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ route('faqs') }}" class="btn-default">view all faqs</a>
                    </div>
                    <!-- Section Button End -->
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Our FAQs Content Start -->
                    <div class="our-faqs-content">
                        <!-- FAQ Accordion Start -->
                        <div class="faq-accordion" id="accordion">
                            @foreach($faqs as $faq)
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="{{ $loop->index * 0.2 }}s">
                                    <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                                        <button class="accordion-button @if(!$loop->first) collapsed @endif" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#collapse{{ $loop->iteration }}" 
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}" 
                                                aria-controls="collapse{{ $loop->iteration }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->iteration }}" 
                                         class="accordion-collapse collapse @if($loop->first) show @endif" 
                                         aria-labelledby="heading{{ $loop->iteration }}" 
                                         data-bs-parent="#accordion">
                                        <div class="accordion-body">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->
                            @endforeach
                        </div>
                        <!-- FAQ Accordion End -->
                    </div>
                    <!-- Our FAQs Content End -->
                </div>

                <div class="col-lg-6">
                    <!-- Faqs Image Start -->
                    <div class="faqs-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('frontend/images/faqs-image.jpg') }}" alt="">
                        </figure>

                        <!-- Faqs Contact Box Start -->
                        <div class="faqs-contact-box">
                            <div class="icon-box">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <div class="faqs-contact-box-content">
                                <h3>Still have Question?</h3>
                                <p><a href="tel:+447349925427">+44 7349 925427</a></p>
                            </div>
                        </div>
                        <!-- Faqs Contact Box End -->
                    </div>
                    <!-- Faqs Image End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Faqs Section End -->
@endif