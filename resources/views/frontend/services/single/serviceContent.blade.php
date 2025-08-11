<!-- Page Service Single Start -->
<div class="page-service-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Page Single Sidebar Start -->
                <div class="page-single-sidebar">
                    <!-- Page Category List Start -->
                    <div class="page-catagery-list wow fadeInUp">
                        <h3>Our Services</h3>
                        <ul>
                            @foreach($otherServices as $otherService)
                                <li>
                                    <a href="{{ route('services.show', $otherService->slug) }}" 
                                       class="{{ $otherService->id === $service->id ? 'active' : '' }}">
                                        {{ $otherService->title }}
                                    </a>
                                </li>
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
                <!-- Service Single Content Start -->
                <div class="service-single-content">
                    <!-- Service Featured Image Start -->
                    <div class="service-featured-image">
                        <figure class="image-anime reveal">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                            @else
                                <img src="{{ asset('frontend/images/service-featured-image.jpg') }}" alt="{{ $service->title }}">
                            @endif
                        </figure>
                    </div>
                    <!-- Service Featured Image End -->
                    
                    <!-- Service Entry Start -->
                    <div class="service-entry">
                        {!! $service->description !!}
                        
                        <!-- If description is short, add default content blocks -->
                        @if(strlen(strip_tags($service->description)) < 500)
                            <!-- Discover Peace Box Start -->
                            <div class="discover-peace-box">
                                <h2 class="text-anime-style-2">Discover peace <span>within your mind</span></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.4s">Experience the tranquility of {{ strtolower($service->title) }} as you learn to quiet your thoughts, reduce stress, and embrace the present moment. Unlock a sense of inner calm.</p>

                                <!-- Discover Peace Item List Start -->
                                <div class="discover-peace-item-list">
                                    <!-- Discover Peace Item Start -->
                                    <div class="discover-peace-item wow fadeInUp">
                                        <div class="icon-box">
                                            <img src="{{ asset('frontend/images/icon-service-item-1.svg') }}" alt="">
                                        </div>
                                        <div class="discover-peace-item-content">
                                            <h3>Enhanced Self-Awareness</h3>
                                            <p>{{ $service->title }} helps connect deeply with your thoughts.</p>
                                        </div>
                                    </div>
                                    <!-- Discover Peace Item End -->
                                    
                                    <!-- Discover Peace Item Start -->
                                    <div class="discover-peace-item wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="icon-box">
                                            <img src="{{ asset('frontend/images/icon-service-item-3.svg') }}" alt="">
                                        </div>
                                        <div class="discover-peace-item-content">
                                            <h3>Experienced Instructors</h3>
                                            <p>Learn from certified professionals with years of experience.</p>
                                        </div>
                                    </div>
                                    <!-- Discover Peace Item End -->
                                </div>
                                <!-- Discover Peace Item List End -->
                                
                                <!-- Discover Peace Info Box Start -->
                                <div class="discover-peace-info-box wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="icon-box">
                                        <img src="{{ asset('frontend/images/icon-discover-peace.svg') }}" alt="">
                                    </div>
                                    <div class="discover-peace-info-content">
                                        <h3>Experience guided sessions tailored for all levels, techniques improved a focus, emotional balance, enhanced self-awareness.</h3>
                                    </div>
                                </div>
                                <!-- Discover Peace Info Box End -->
                            </div>
                            <!-- Discover Peace Box End -->

                            <!-- Discover Benefits Box Start -->
                            <div class="service-benefits-box">
                                <h2 class="text-anime-style-2">Unlock benefits of <span>mindful living</span></h2>
                                <p class="wow fadeInUp">Embrace the power of mindfulness to reduce stress, improve focus, and enhance emotional well-being. Discover a balanced and fulfilling life through guided meditation and holistic wellness practices.</p>
                                
                                <ul class="wow fadeInUp" data-wow-delay="0.2s">
                                    <li>Reduce Stress and Anxiety</li>
                                    <li>Achieve Emotional Balance</li>
                                    <li>Boost Resilience in Everyday</li>
                                    <li>Improve Concentration</li>
                                    <li>Enhance Self-Awareness</li>
                                    <li>Foster a Positive and Mindful</li>
                                </ul>
                                
                                <!-- Discover Benefits Image Start -->
                                <div class="service-benefits-image">
                                    <figure class="image-anime reveal">
                                        <img src="{{ asset('frontend/images/service-benefits-img.jpg') }}" alt="">
                                    </figure>
                                </div>
                                <!-- Discover Benefits Image End -->
                            </div>
                            <!-- Discover Benefits Box End -->

                            <!-- Service Process Box Start -->
                            <div class="service-process-box">
                                <h2 class="text-anime-style-2">Guided process for <span>inner peace</span></h2>
                                <p class="wow fadeInUp">Our {{ strtolower($service->title) }} sessions provide step-by-step guidance to help you achieve deep inner peace. Through focused breathing, mindful awareness, and meditation techniques, we lead you on a journey to calm the mind, reduce stress, and cultivate emotional balance.</p>

                                <!-- How Work Steps Box Start -->
                                <div class="service-process-steps">
                                    <!-- How Work Step Start -->
                                    <div class="how-work-step wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="how-work-step-no">
                                            <h2>01</h2>
                                        </div>
                                        <div class="how-work-step-content">
                                            <h3>Choose Your Practice</h3>
                                            <p>Select the {{ strtolower($service->title) }} session that best suits your needs and experience level.</p>
                                        </div>
                                    </div>
                                    <!-- How Work Step End -->

                                    <!-- How Work Step Start -->
                                    <div class="how-work-step wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="how-work-step-no">
                                            <h2>02</h2>
                                        </div>
                                        <div class="how-work-step-content">
                                            <h3>Schedule Your Session</h3>
                                            <p>Book a convenient time that fits your schedule and prepares you for the practice.</p>
                                        </div>
                                    </div>
                                    <!-- How Work Step End -->

                                    <!-- How Work Step Start -->
                                    <div class="how-work-step wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="how-work-step-no">
                                            <h2>03</h2>
                                        </div>
                                        <div class="how-work-step-content">
                                            <h3>Practice Mindfulness Daily</h3>
                                            <p>Apply the techniques learned to create a sustainable mindfulness practice in your daily life.</p>
                                        </div>
                                    </div>
                                    <!-- How Work Step End -->
                                </div>
                                <!-- How Work Steps Box End -->
                            </div>
                            <!-- Service Process Box End -->
                        @endif
                    </div>
                    <!-- Service Entry End -->

                    <!-- Page Single FAQs Start -->
                    <div class="page-single-faqs">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Frequently asked questions</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Frequently asked <span>questions</span></h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- FAQ Accordion Start -->
                        <div class="faq-accordion" id="faqaccordion">
                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                                <h2 class="accordion-header" id="faqheading1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse1" aria-expanded="true" aria-controls="faqcollapse1">
                                        What is {{ strtolower($service->title) }}, and how can it benefit me?
                                    </button>
                                </h2>
                                <div id="faqcollapse1" class="accordion-collapse collapse" aria-labelledby="faqheading1" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>{{ $service->title }} is a transformative practice that helps you achieve balance, reduce stress, and enhance your overall well-being. Our expert instructors will guide you through techniques suitable for all levels.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                                <h2 class="accordion-header" id="faqheading2">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse2" aria-expanded="false" aria-controls="faqcollapse2">
                                        Do I need prior experience to join this class?
                                    </button>
                                </h2>
                                <div id="faqcollapse2" class="accordion-collapse collapse show" aria-labelledby="faqheading2" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>No prior experience is required. Our {{ strtolower($service->title) }} classes cater to all levels, from beginners to advanced practitioners. Instructors will guide you every step of the way.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                                <h2 class="accordion-header" id="faqheading3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse3" aria-expanded="false" aria-controls="faqcollapse3">
                                        What should I bring to the session?
                                    </button>
                                </h2>
                                <div id="faqcollapse3" class="accordion-collapse collapse" aria-labelledby="faqheading3" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>For {{ strtolower($service->title) }} sessions, we recommend comfortable clothing, a water bottle, and an open mind. We provide all necessary equipment including mats and props.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->    

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s">
                                <h2 class="accordion-header" id="faqheading4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse4" aria-expanded="false" aria-controls="faqcollapse4">
                                        How long are the sessions?
                                    </button>
                                </h2>
                                <div id="faqcollapse4" class="accordion-collapse collapse" aria-labelledby="faqheading4" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>{{ $service->title }} sessions typically last between 60-90 minutes, depending on the class format. We offer both shorter express sessions and extended workshops.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="1s">
                                <h2 class="accordion-header" id="faqheading5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqcollapse5" aria-expanded="false" aria-controls="faqcollapse5">
                                        Can I book a private session?
                                    </button>
                                </h2>
                                <div id="faqcollapse5" class="accordion-collapse collapse" aria-labelledby="faqheading5" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>Yes, we offer private {{ strtolower($service->title) }} sessions tailored to your specific needs and goals. Contact us to discuss scheduling and personalized session plans.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                        </div>
                        <!-- FAQ Accordion End -->
                    </div>
                    <!-- Page Single FAQs End -->

                    <!-- Call to Action Section -->
                    <div class="service-cta-section mt-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h3>Ready to begin your {{ strtolower($service->title) }} journey?</h3>
                                <p>Book your first session today and experience the transformative benefits.</p>
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                <a href="{{ route('appointments.create') }}" class="btn-default">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service Single Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Service Single End -->