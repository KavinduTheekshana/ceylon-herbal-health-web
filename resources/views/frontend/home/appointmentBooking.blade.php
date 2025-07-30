<!-- File: resources/views/frontend/home/appointmentBooking.blade.php -->

<!-- Appointment Booking Section Start -->
<div class="appointment-booking">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Book Appointment</h3>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">Schedule Your <span>Healing Session</span> Today</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-6">
                <!-- Section Title Content Start -->
                <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                    <p>Experience authentic Sri Lankan Ayurveda with our qualified practitioners. Book your personalized consultation and begin your journey to natural healing and wellness.</p>
                </div>
                <!-- Section Title Content End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Appointment Booking Content Start -->
                <div class="appointment-booking-content">
                    <div class="row">
                        <!-- Left Side: Booking Form -->
                        <div class="col-lg-8">
                            <!-- Booking Form Box Start -->
                            <div class="booking-form-box wow fadeInUp">
                                <!-- Step Progress Start -->
                                <div class="booking-steps">
                                    <div class="step-item active" data-step="1">
                                        <div class="step-icon">
                                            <i class="fa-solid fa-clipboard-list"></i>
                                        </div>
                                        <span>Service Selection</span>
                                    </div>
                                    <div class="step-item" data-step="2">
                                        <div class="step-icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                        <span>Date & Time</span>
                                    </div>
                                    <div class="step-item" data-step="3">
                                        <div class="step-icon">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <span>Your Information</span>
                                    </div>
                                </div>
                                <!-- Step Progress End -->

                                <!-- Booking Form Start -->
                                <form id="appointmentForm" action="{{ route('appointments.store') }}" method="POST">
                                    @csrf
                                    
                                    <!-- Step 1: Service Selection -->
                                    <div class="form-step step-1 active">
                                        <div class="step-content">
                                            <h4>Select Your Treatment</h4>
                                            <p>Choose the service you would like to book</p>
                                            
                                            <div class="service-selection">
                                                @foreach($allServices as $service)
                                                <div class="service-option">
                                                    <input type="radio" id="service_{{ $service->id }}" name="service_id" value="{{ $service->id }}" required>
                                                    <label for="service_{{ $service->id }}" class="service-label">
                                                        <div class="service-info">
                                                            <div class="service-icon">
                                                                @if($service->icon)
                                                                    <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}">
                                                                @else
                                                                    <i class="fa-solid fa-leaf"></i>
                                                                @endif
                                                            </div>
                                                            <div class="service-details">
                                                                <h5>{{ $service->title }}</h5>
                                                                <p>{{ $service->short_description }}</p>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>

                                            <!-- Employee Selection -->
                                            <div class="form-group mt-4">
                                                <label for="practitioner">Preferred Practitioner (Optional)</label>
                                                <select name="practitioner_id" id="practitioner" class="form-control">
                                                    <option value="">Any Available Practitioner</option>
                                                    <option value="1">Dr. Kumara Perera - Senior Physician</option>
                                                    <option value="2">Dr. Anisha Silva - Women's Health Specialist</option>
                                                    <option value="3">Therapist Nimal Fernando - Senior Therapist</option>
                                                </select>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn-default btn-next">Continue <i class="fa-solid fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Step 2: Date & Time Selection -->
                                    <div class="form-step step-2">
                                        <div class="step-content">
                                            <h4>Select Date & Time</h4>
                                            <p>Choose your preferred appointment date and time</p>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="preferred_date">Preferred Date</label>
                                                        <input type="date" id="preferred_date" name="preferred_date" class="form-control" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="preferred_time">Preferred Time</label>
                                                        <select name="preferred_time" id="preferred_time" class="form-control" required>
                                                            <option value="">Select Time</option>
                                                            <option value="09:00">9:00 AM</option>
                                                            <option value="09:30">9:30 AM</option>
                                                            <option value="10:00">10:00 AM</option>
                                                            <option value="10:30">10:30 AM</option>
                                                            <option value="11:00">11:00 AM</option>
                                                            <option value="11:30">11:30 AM</option>
                                                            <option value="14:00">2:00 PM</option>
                                                            <option value="14:30">2:30 PM</option>
                                                            <option value="15:00">3:00 PM</option>
                                                            <option value="15:30">3:30 PM</option>
                                                            <option value="16:00">4:00 PM</option>
                                                            <option value="16:30">4:30 PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn-secondary btn-back"><i class="fa-solid fa-arrow-left"></i> Back</button>
                                                <button type="button" class="btn-default btn-next">Continue <i class="fa-solid fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Step 3: Personal Information -->
                                    <div class="form-step step-3">
                                        <div class="step-content">
                                            <h4>Your Information</h4>
                                            <p>Please provide your contact details</p>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Full Name *</label>
                                                        <input type="text" id="name" name="name" class="form-control" required placeholder="Enter your full name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email Address *</label>
                                                        <input type="email" id="email" name="email" class="form-control" required placeholder="Enter your email">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">Phone Number *</label>
                                                        <input type="tel" id="phone" name="phone" class="form-control" required placeholder="Enter your phone number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="age">Age</label>
                                                        <input type="number" id="age" name="age" class="form-control" placeholder="Your age" min="1" max="120">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="message">Health Concerns / Message (Optional)</label>
                                                <textarea id="message" name="message" class="form-control" rows="4" placeholder="Please describe any specific health concerns or questions you have..."></textarea>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn-secondary btn-back"><i class="fa-solid fa-arrow-left"></i> Back</button>
                                                <button type="submit" class="btn-default btn-submit">
                                                    <i class="fa-solid fa-calendar-check"></i> Book Appointment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Booking Form End -->
                            </div>
                            <!-- Booking Form Box End -->
                        </div>

                        <!-- Right Side: Information & Benefits -->
                        <div class="col-lg-4">
                            <!-- Booking Info Box Start -->
                            <div class="booking-info-box wow fadeInUp" data-wow-delay="0.2s">
                                <!-- Why Book With Us -->
                                <div class="booking-benefits">
                                    <h4>Why Book With Us?</h4>
                                    <ul class="benefits-list">
                                        <li>
                                            <i class="fa-solid fa-check-circle"></i>
                                            <span>Qualified Sri Lankan Ayurvedic Doctors</span>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-check-circle"></i>
                                            <span>20+ Years Combined Experience</span>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-check-circle"></i>
                                            <span>Personalized Treatment Plans</span>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-check-circle"></i>
                                            <span>Authentic Traditional Methods</span>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-check-circle"></i>
                                            <span>Free Initial Consultation</span>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-check-circle"></i>
                                            <span>Natural Herbal Medicines</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Special Offer -->
                                <div class="special-offer">
                                    <div class="offer-icon">
                                        <i class="fa-solid fa-gift"></i>
                                    </div>
                                    <div class="offer-content">
                                        <h5>Special Offer</h5>
                                        <p>First-time patients get <strong>20% off</strong> their initial consultation</p>
                                    </div>
                                </div>

                                <!-- Contact Options -->
                                <div class="quick-contact">
                                    <h5>Need Help?</h5>
                                    <div class="contact-options">
                                        <a href="tel:+447349925427" class="contact-btn phone-btn">
                                            <i class="fa-solid fa-phone"></i>
                                            <span>Call Us<br><strong>+44 73 499 25427</strong></span>
                                        </a>
                                        <a href="https://wa.me/447349925427?text=Hello! I would like to book an appointment for Ayurvedic treatment." class="contact-btn whatsapp-btn" target="_blank">
                                            <i class="fa-brands fa-whatsapp"></i>
                                            <span>WhatsApp<br><strong>Chat Now</strong></span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Response Time -->
                                <div class="response-info">
                                    <i class="fa-solid fa-clock"></i>
                                    <span>We'll confirm your appointment within <strong>2 hours</strong></span>
                                </div>
                            </div>
                            <!-- Booking Info Box End -->
                        </div>
                    </div>
                </div>
                <!-- Appointment Booking Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Appointment Booking Section End -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Multi-step form functionality
    const steps = document.querySelectorAll('.form-step');
    const stepItems = document.querySelectorAll('.step-item');
    const nextBtns = document.querySelectorAll('.btn-next');
    const backBtns = document.querySelectorAll('.btn-back');
    let currentStep = 1;

    // Next button functionality
    nextBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (validateCurrentStep()) {
                currentStep++;
                updateStep();
            }
        });
    });

    // Back button functionality
    backBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            currentStep--;
            updateStep();
        });
    });

    function updateStep() {
        // Update form steps
        steps.forEach((step, index) => {
            if (index + 1 === currentStep) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });

        // Update step indicators
        stepItems.forEach((item, index) => {
            if (index + 1 < currentStep) {
                item.classList.add('completed');
                item.classList.remove('active');
            } else if (index + 1 === currentStep) {
                item.classList.add('active');
                item.classList.remove('completed');
            } else {
                item.classList.remove('active', 'completed');
            }
        });
    }

    function validateCurrentStep() {
        const currentStepElement = document.querySelector(`.step-${currentStep}`);
        const requiredFields = currentStepElement.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = '#dc3545';
                isValid = false;
            } else {
                field.style.borderColor = '#e0e0e0';
            }
        });

        return isValid;
    }

    // Form submission
    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateCurrentStep()) {
            // Show loading state
            const submitBtn = document.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Booking...';
            submitBtn.disabled = true;

            // Submit form
            this.submit();
        }
    });

    // Service selection enhancement
    const serviceOptions = document.querySelectorAll('input[name="service_id"]');
    serviceOptions.forEach(option => {
        option.addEventListener('change', function() {
            // Auto-advance to next step after service selection
            setTimeout(() => {
                if (document.querySelector('.btn-next')) {
                    document.querySelector('.btn-next').click();
                }
            }, 500);
        });
    });

    // Date input minimum date
    const dateInput = document.getElementById('preferred_date');
    if (dateInput) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        dateInput.min = tomorrow.toISOString().split('T')[0];
    }
});
</script>
@endpush