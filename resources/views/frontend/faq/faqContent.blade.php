<!-- Page Faqs Start -->
<div class="page-faqs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Page Single Sidebar Start -->
                <div class="page-single-sidebar">
                    <!-- Page Category List Start -->
                    <div class="page-catagery-list wow fadeInUp">
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="#faq_{{ $loop->iteration }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Page Category List End -->
                    
                    <!-- Sidebar CTA Box Start -->
                    <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                        <div class="sidebar-cta-image">
                            <figure class="image-anime">
                                <img src="{{ asset('frontend/images/sidebar-cta-img.jpg') }}" alt="">
                            </figure>
                        </div>
                        <div class="sidebar-cta-content">
                            <h3>Reach Out to Start Your Mindful Wellness Journey</h3>
                            <a href="{{ route('contact') }}" class="btn-default">Let's talk</a>
                        </div>
                    </div>
                    <!-- Sidebar CTA Box End -->
                </div>
                <!-- Page Single Sidebar End -->
            </div>

            <div class="col-lg-8">
                <!-- Page FAQs Category Start -->
                <div class="page-faqs-catagery">
                    @forelse($categories as $category)
                        <!-- FAQs section start -->
                        <div class="page-single-faqs page-faq-accordion" id="faq_{{ $loop->iteration }}">
                            <div class="section-title">
                                <h2 class="text-anime-style-2" data-cursor="-opaque">
                                    @php
                                        $words = explode(' ', $category->name);
                                        $lastWord = array_pop($words);
                                        $firstWords = implode(' ', $words);
                                    @endphp
                                    {{ $firstWords }} <span>{{ $lastWord }}</span>
                                </h2>
                                @if($category->description)
                                    <p class="mt-3">{{ $category->description }}</p>
                                @endif
                            </div>
                            
                            <!-- FAQ Accordion Start -->
                            <div class="faq-accordion" id="accordion{{ $loop->iteration }}">
                                @foreach($category->faqs as $faq)
                                    <!-- FAQ Item Start -->
                                    <div class="accordion-item wow fadeInUp" data-wow-delay="{{ $loop->index * 0.2 }}s">
                                        <h2 class="accordion-header" id="heading{{ $category->id }}_{{ $faq->id }}">
                                            <button class="accordion-button @if(!($loop->parent->first && $loop->first)) collapsed @endif" 
                                                    type="button" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#collapse{{ $category->id }}_{{ $faq->id }}" 
                                                    aria-expanded="{{ $loop->parent->first && $loop->first ? 'true' : 'false' }}" 
                                                    aria-controls="collapse{{ $category->id }}_{{ $faq->id }}">
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $category->id }}_{{ $faq->id }}" 
                                             class="accordion-collapse collapse @if($loop->parent->first && $loop->first) show @endif" 
                                             aria-labelledby="heading{{ $category->id }}_{{ $faq->id }}" 
                                             data-bs-parent="#accordion{{ $loop->parent->iteration }}">
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
                        <!-- FAQs section End -->
                    @empty
                        <div class="text-center py-5">
                            <h3>No FAQs available at the moment</h3>
                            <p>Please check back later or <a href="{{ route('contact') }}">contact us</a> if you have any questions.</p>
                        </div>
                    @endforelse
                </div>
                <!-- Page FAQs Category End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Faqs End -->