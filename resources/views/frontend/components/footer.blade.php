 <!-- Footer Main Start -->
 <footer class="footer-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Footer Header Start -->
                <div class="footer-header">
                    <!-- Footer About Start -->
                    <div class="footer-about">
                        <div class="footer-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('frontend/images/logoweb.svg') }}" alt="Ceylon Herbal Health" width="200">
                            </a>
                        </div>
                        <div class="about-footer-content">
                            <p>Holistic practices for inner peace, focus, and overall well-being.</p>
                        </div>
                    </div>
                    <!-- Footer About End -->

                    <!-- Footer Social Links Start -->
                    <div class="footer-social-links">
                        <ul>
                            <li><a href="https://www.facebook.com/ceylonherbalhealth/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/ceylonherbalhealth" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- Footer Social Links End -->
                </div>
                <!-- Footer Header End -->
            </div>

            <div class="col-lg-2 col-md-3">
                <!-- Footer Links Start -->
                <div class="footer-links">
                    <h3>Quick link</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('services.index') }}">Services</a></li>
                        <li><a href="{{ route('faq') }}">FAQ's</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <!-- Footer Links End -->
            </div>

            <div class="col-lg-2 col-md-4">
              <!-- Footer Links Start -->
<div class="footer-links">
    <h3>Services</h3>
    <ul>
        @php
            $footerServices = \App\Models\Service::active()->orderBy('order')->limit(5)->get();
        @endphp
        @foreach($footerServices as $service)
            <li><a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a></li>
        @endforeach
    </ul>
</div>
<!-- Footer Links End -->
            </div>

            <div class="col-lg-3 col-md-5">
                <!-- Footer Contact Links Start -->
                <div class="footer-links footer-contact-links">
                    <h3>Contact</h3>
                    <ul>
                        <li><a href="tel:+447349925427">+44 73 499 25427</a></li>
                        <li><a href="mailto:info@ceylonherbalhealth.co.uk">info@ceylonherbalhealth.co.uk</a></li>
                        <li><a href="https://www.google.com/maps/place/Ceylon+Herbal+Health/@52.9233263,-1.481929,20.87z/data=!4m14!1m7!3m6!1s0x4879f10fe076c3c9:0xc327500fb4aee50b!2sThe+Art+house+Studios!8m2!3d52.9233337!4d-1.4819144!16s%2Fg%2F11sw1fvcxq!3m5!1s0x4879f1de25056f35:0xaf51b0aa5da45385!8m2!3d52.9233037!4d-1.4819047!16s%2Fg%2F11lzsnt0n4" target="_blank" rel="noopener noreferrer">Studio 2, The Art House, Friar Gate, Derby DE1 1BU</a></li>
                    </ul>
                </div>
                <!-- Footer Contact Links End -->
            </div>

            <div class="col-lg-5">
                <!-- Footer Newsletter Box Start -->
                <div class="footer-newsletter-box">
                    <!-- Footer Newsletter Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Subscribe for Yoga Tips and Inspiration</h2>
                    </div>
                    <!-- Footer Newsletter Title End -->

                    <!-- Newsletter Form start -->
                    <div class="newsletter-form">
                        <form id="newsletterForm" action="#" method="POST">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="mail" placeholder="Enter Your Email" required>
                                <button type="submit" class="newsletter-btn"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- Newsletter Form end -->
                </div>
                <!-- Footer Newsletter Box End -->
            </div>

            <div class="col-lg-12">
                <!-- Footer Copyright Section Start -->
                <div class="footer-copyright">
                    <!-- Footer Copyright Text Start -->
                    <div class="footer-copyright-text">
                        <p>Copyright © 2025 All Rights Reserved.</p>
                    </div>
                    <!-- Footer Copyright Text End -->

                    <!-- Footer Privacy Policy Start -->
                    <div class="footer-privacy-policy">
                        <ul>
                            <li><a href="{{ route('privacy') }}">Privacy policy</a></li>
                            <li><a href="{{ route('terms') }}">Terms & conditions</a></li>
                            <li><a href="{{ route('contact') }}">Help</a></li>
                        </ul>
                    </div>
                    <!-- Footer Privacy Policy End -->
                </div>
                <!-- Footer Copyright Section End -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Main End -->
