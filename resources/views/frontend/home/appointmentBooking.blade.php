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

        <!-- Booking Form Row - Centered -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Appointment Booking Content Start -->
                <div class="appointment-booking-content">
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

                                            <!-- Service Selection with Cards -->
                                            <div class="form-group">
                                                <label class="service-selection-label">
                                                    <i class="fa-solid fa-spa"></i> Select Your Treatment *
                                                </label>
                                                <p class="service-selection-subtitle">Choose the service that best fits your wellness needs</p>

                                                <!-- Hidden input to store selected service -->
                                                <input type="hidden" name="service_id" id="service_id" required>

                                                <!-- Service Cards Grid -->
                                                <div class="service-cards-grid">
                                                    @foreach($allServices as $service)
                                                    <div class="service-card" data-service-id="{{ $service->id }}">
                                                        <div class="service-card-icon">
                                                            @if($service->icon)
                                                                <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}">
                                                            @else
                                                                <i class="fa-solid fa-leaf"></i>
                                                            @endif
                                                        </div>
                                                        <div class="service-card-content">
                                                            <h5 class="service-card-title">{{ $service->title }}</h5>
                                                            <p class="service-card-description">{{ $service->short_description ?? 'Authentic Ayurvedic treatment for your wellness' }}</p>
                                                        </div>
                                                        <div class="service-card-check">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Therapist Selection (Dynamic based on service) -->
                                            <div class="form-group custom-select-wrapper mt-4" id="therapist-group" style="display: none;">
                                                <label for="therapist_id">
                                                    <i class="fa-solid fa-user-doctor"></i> Preferred Therapist *
                                                </label>
                                                <div class="select-container">
                                                    <select name="therapist_id" id="therapist_id" class="form-control custom-select" required>
                                                        <option value="">Please select a service first</option>
                                                    </select>
                                                    <i class="fa-solid fa-chevron-down select-arrow"></i>
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fa-solid fa-circle-info"></i> Choose your preferred therapist for this treatment
                                                </small>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn-default btn-next">
                                                    Continue  &nbsp &nbsp &nbsp 
                                                </button>
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
                                                <button type="button" class="btn-default btn-next">Continue &nbsp &nbsp &nbsp </button>
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
                                                    <i class="fa-solid fa-calendar-check"></i> Book Appointment &nbsp &nbsp &nbsp
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Booking Form End -->
                            </div>
                            <!-- Booking Form Box End -->
                </div>
                <!-- Appointment Booking Content End -->
            </div>
        </div>

        <!-- Why Book With Us Section - Full Width Row -->
        {{-- <div class="row why-book-section">
            <div class="col-lg-12">
                <div class="why-book-container wow fadeInUp" data-wow-delay="0.3s">
                    <!-- Section Header -->
                    <div class="why-book-header">
                        <h3>Why Book With Us?</h3>
                        <p>Experience authentic Ayurvedic care with our qualified practitioners</p>
                    </div>

                    <!-- Benefits Grid -->
                    <div class="benefits-grid">
                        <div class="benefit-item wow fadeInUp" data-wow-delay="0.1s">
                            <div class="benefit-icon">
                                <i class="fa-solid fa-user-doctor"></i>
                            </div>
                            <h5>Qualified Ayurvedic Practitioners</h5>
                            <p>Experienced doctors trained in traditional Sri Lankan Ayurvedic medicine</p>
                        </div>

                        <div class="benefit-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="benefit-icon">
                                <i class="fa-solid fa-clipboard-check"></i>
                            </div>
                            <h5>Personalized Treatment Plans</h5>
                            <p>Customized care tailored to your unique health needs and goals</p>
                        </div>

                        <div class="benefit-item wow fadeInUp" data-wow-delay="0.3s">
                            <div class="benefit-icon">
                                <i class="fa-solid fa-leaf"></i>
                            </div>
                            <h5>Natural Herbal Remedies</h5>
                            <p>Pure, organic herbs and authentic Ayurvedic medicines for safe healing</p>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="booking-contact-section">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="contact-info-card">
                                    <h4>Need Help Booking?</h4>
                                    <p>Our team is here to assist you with any questions</p>
                                    <div class="response-time">
                                        <i class="fa-solid fa-clock"></i>
                                        <span>Response within <strong>2 hours</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="contact-buttons">
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
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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

    // Service card selection - Handle card clicks
    const serviceCards = document.querySelectorAll('.service-card');
    const serviceInput = document.getElementById('service_id');
    const therapistGroup = document.getElementById('therapist-group');
    const therapistSelect = document.getElementById('therapist_id');

    // Handle service card selection
    serviceCards.forEach(card => {
        card.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-service-id');

            // Remove selected class from all cards
            serviceCards.forEach(c => c.classList.remove('selected'));

            // Add selected class to clicked card
            this.classList.add('selected');

            // Set the hidden input value
            serviceInput.value = serviceId;

            // Trigger therapist loading
            loadTherapists(serviceId);
        });
    });

    // Function to load therapists
    function loadTherapists(serviceId) {
        if (serviceId) {
            // Show loading state with animation
            therapistSelect.innerHTML = '<option value="">Loading therapists...</option>';
            therapistSelect.disabled = true;
            therapistSelect.classList.add('loading');
            therapistGroup.style.display = 'block';

            // Fetch therapists for selected service
            fetch(`/api/services/${serviceId}/therapists`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Therapists data:', data); // Debug log

                    // Remove loading state
                    therapistSelect.classList.remove('loading');
                    therapistSelect.innerHTML = '';

                    if (data.success && data.therapists && data.therapists.length > 0) {
                        // Add default option
                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = 'Select your preferred therapist...';
                        therapistSelect.appendChild(defaultOption);

                        // Add therapists
                        data.therapists.forEach(therapist => {
                            const option = document.createElement('option');
                            option.value = therapist.id;
                            option.textContent = therapist.specialization
                                ? `${therapist.name} - ${therapist.specialization}`
                                : therapist.name;
                            therapistSelect.appendChild(option);
                        });

                        therapistSelect.disabled = false;
                        therapistSelect.classList.add('success');

                        // Remove success class after animation
                        setTimeout(() => {
                            therapistSelect.classList.remove('success');
                        }, 2000);
                    } else {
                        // No therapists available
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = data.message || 'No therapists available for this service';
                        therapistSelect.appendChild(option);
                        therapistSelect.disabled = true;
                    }
                })
                .catch(error => {
                    console.error('Error loading therapists:', error);
                    therapistSelect.classList.remove('loading');
                    therapistSelect.classList.add('error');
                    therapistSelect.innerHTML = `<option value="">Error loading therapists. Please try again.</option>`;
                    therapistSelect.disabled = true;

                    // Remove error class after animation
                    setTimeout(() => {
                        therapistSelect.classList.remove('error');
                    }, 3000);
                });
        } else {
            // Hide therapist selection if no service selected
            therapistGroup.style.display = 'none';
            therapistSelect.innerHTML = '<option value="">Please select a service first</option>';
            therapistSelect.classList.remove('success', 'error', 'loading');
        }
    }

    // Add visual feedback on therapist selection
    if (therapistSelect) {
        therapistSelect.addEventListener('change', function() {
            if (this.value) {
                this.classList.add('success');
                setTimeout(() => {
                    this.classList.remove('success');
                }, 1000);
            }
        });
    }

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