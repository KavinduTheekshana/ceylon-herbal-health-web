<!-- Page Contact Us Start -->
<div class="page-contact-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Contact Us Content Start -->
                <div class="contact-us-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">contact us</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Get in touch <span>with us</span></h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s"> We're here to support your journey to better
                            health and well-being. Reach out today to ask questions, schedule a consultation.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Contact Info List Start -->
                    <div class="contact-info-list">
                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-phone.svg') }}" alt="Phone">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Contact Item Content Start -->
                            <div class="contact-item-content">
                                <h3>contact us</h3>
                                <p><a href="tel:+447349925427">+44 7349 925427</a></p>
                            </div>
                            <!-- Contact Item Content End -->
                        </div>
                        <!-- Contact Info Item End -->

                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-mail.svg') }}" alt="Email">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Contact Item Content Start -->
                            <div class="contact-item-content">
                                <h3>email us</h3>
                                <p><a href="mailto:info@ayurveda-wellness.com">info@ayurveda-wellness.com</a></p>
                            </div>
                            <!-- Contact Item Content End -->
                        </div>
                        <!-- Contact Info Item End -->

                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-location.svg') }}" alt="Location">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Contact Item Content Start -->
                            <div class="contact-item-content">
                                <h3>location</h3>
                                <p>Studio 2, The Art House, Friar Gate, Derby DE1 1BU</p>
                            </div>
                            <!-- Contact Item Content End -->
                        </div>
                        <!-- Contact Info Item End -->

                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.6s">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="{{ asset('frontend/images/icon-clock.svg') }}" alt="Hours">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Contact Item Content Start -->
                            <div class="contact-item-content">
                                <h3>open hours</h3>
                                <p>Mon-Sat (09:00 - 21:00)</p>
                            </div>
                            <!-- Contact Item Content End -->
                        </div>
                        <!-- Contact Info Item End -->
                    </div>
                    <!-- Contact Info List End -->

                    <!-- Contact Social List Start -->
                    <div class="contact-social-list wow fadeInUp" data-wow-delay="0.8s">
                        <h3>Follow On Social :</h3>
                        <ul>
                            <li><a href="https://www.facebook.com/ceylonherbalhealth/" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/ceylonherbalhealth" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- Contact Social List End -->
                </div>
                <!-- Contact Us Content End -->
            </div>

            <div class="col-lg-6">
                <!-- Contact Us Form Section Start -->
                <div class="contact-us-form">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Send us a <span>message</span></h2>
                    </div>
                    <!-- Section Title End -->

                    <!-- Contact Form Start -->
                    <div class="contact-form">
                        <form id="contactForm" action="{{ route('contact.store') }}" method="POST" 
                              class="wow fadeInUp" data-wow-delay="0.2s">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" 
                                           name="fname" 
                                           class="form-control @error('fname') is-invalid @enderror" 
                                           id="fname"
                                           placeholder="First name" 
                                           value="{{ old('fname') }}"
                                           required>
                                    @error('fname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" 
                                           name="lname" 
                                           class="form-control @error('lname') is-invalid @enderror" 
                                           id="lname"
                                           placeholder="Last name" 
                                           value="{{ old('lname') }}"
                                           required>
                                    @error('lname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email"
                                           placeholder="E-mail" 
                                           value="{{ old('email') }}"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" 
                                           name="phone" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone"
                                           placeholder="Phone" 
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 mb-5">
                                    <textarea name="message" 
                                              class="form-control @error('message') is-invalid @enderror" 
                                              id="message" 
                                              rows="4" 
                                              placeholder="Write your message..."
                                              required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-default" id="contactSubmitBtn">
                                        <span class="btn-text">Send Message</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form End -->
                </div>
                <!-- Contact Us Form Section End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Contact Us End -->