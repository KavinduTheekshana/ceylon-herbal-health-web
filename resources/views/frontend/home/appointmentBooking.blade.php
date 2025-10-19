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
                                            <p id="calendar-subtitle">Choose an available date from the calendar below</p>

                                            <!-- Hidden inputs for date and time -->
                                            <input type="hidden" name="preferred_date" id="preferred_date" required>
                                            <input type="hidden" name="preferred_time" id="preferred_time" required>

                                            <!-- Calendar and Time Slots Side by Side -->
                                            <div class="calendar-time-wrapper">
                                                <!-- Left Side: Interactive Calendar -->
                                                <div class="appointment-calendar-container">
                                                    <div class="calendar-header">
                                                        <button type="button" class="calendar-nav" id="prev-month">
                                                            <i class="fa-solid fa-chevron-left"></i>
                                                        </button>
                                                        <h3 id="calendar-month-year"></h3>
                                                        <button type="button" class="calendar-nav" id="next-month">
                                                            <i class="fa-solid fa-chevron-right"></i>
                                                        </button>
                                                    </div>

                                                    <div class="calendar-weekdays">
                                                        <div class="weekday">Sun</div>
                                                        <div class="weekday">Mon</div>
                                                        <div class="weekday">Tue</div>
                                                        <div class="weekday">Wed</div>
                                                        <div class="weekday">Thu</div>
                                                        <div class="weekday">Fri</div>
                                                        <div class="weekday">Sat</div>
                                                    </div>

                                                    <div class="calendar-days" id="calendar-days">
                                                        <!-- Days will be generated by JavaScript -->
                                                    </div>

                                                    <div class="calendar-legend">
                                                        <div class="legend-item">
                                                            <span class="legend-color available"></span>
                                                            <span>Available</span>
                                                        </div>
                                                        <div class="legend-item">
                                                            <span class="legend-color unavailable"></span>
                                                            <span>Unavailable</span>
                                                        </div>
                                                        <div class="legend-item">
                                                            <span class="legend-color selected"></span>
                                                            <span>Selected</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Right Side: Time Slot Selection -->
                                                <div class="time-slot-selection" id="time-slot-selection">
                                                    <div class="time-slot-placeholder" id="time-slot-placeholder">
                                                        <i class="fa-solid fa-clock fa-3x"></i>
                                                        <p>Select a date to view available time slots</p>
                                                    </div>
                                                    <div class="time-slot-content" id="time-slot-content" style="display: none;">
                                                        <h5>Available Time Slots</h5>
                                                        <p class="selected-date-display" id="selected-date-display"></p>
                                                        <div class="time-slots-grid" id="time-slots-grid">
                                                            <!-- Time slots will be generated by JavaScript -->
                                                        </div>
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

    </div>
</div>
<!-- Appointment Booking Section End -->
@push('scripts')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                // Store selected therapist ID
                selectedTherapistId = this.value;

                // Load therapist availability calendar
                loadTherapistCalendar(this.value);
            }
        });
    }

    // Calendar functionality
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let therapistAvailability = null;
    let selectedDate = null;
    let selectedTherapistId = null;
    let bookedSlots = [];

    function loadTherapistCalendar(therapistId) {
        fetch(`/api/therapists/${therapistId}/availability`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    therapistAvailability = data;
                    renderCalendar();
                    document.getElementById('calendar-subtitle').textContent =
                        `Select an available date for ${data.therapist.name}`;
                }
            })
            .catch(error => console.error('Error loading calendar:', error));
    }

    function renderCalendar() {
        const calendarDays = document.getElementById('calendar-days');
        const monthYear = document.getElementById('calendar-month-year');

        const firstDay = new Date(currentYear, currentMonth, 1);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startingDayOfWeek = firstDay.getDay();

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'];

        monthYear.textContent = `${monthNames[currentMonth]} ${currentYear}`;

        calendarDays.innerHTML = '';

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < startingDayOfWeek; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.className = 'calendar-day empty';
            calendarDays.appendChild(emptyDay);
        }

        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            dayElement.textContent = day;

            const date = new Date(currentYear, currentMonth, day);
            const dateString = date.toISOString().split('T')[0];
            const dayName = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'][date.getDay()];

            // Check if date is in the past
            if (date < new Date().setHours(0, 0, 0, 0)) {
                dayElement.classList.add('past');
            }
            // Check if therapist is on holiday
            else if (isHoliday(dateString)) {
                dayElement.classList.add('unavailable');
                dayElement.title = 'Therapist unavailable - Holiday';
            }
            // Check if therapist works this day
            else if (therapistAvailability && therapistAvailability.weekly_schedule[dayName]) {
                dayElement.classList.add('available');
                dayElement.addEventListener('click', () => selectDate(dateString, dayElement));
            } else {
                dayElement.classList.add('unavailable');
                dayElement.title = 'Therapist unavailable';
            }

            calendarDays.appendChild(dayElement);
        }
    }

    function isHoliday(dateString) {
        if (!therapistAvailability || !therapistAvailability.holidays) return false;

        return therapistAvailability.holidays.some(holiday => {
            return dateString >= holiday.start_date && dateString <= holiday.end_date;
        });
    }

    function selectDate(dateString, element) {
        selectedDate = dateString;

        // Remove selected class from all days
        document.querySelectorAll('.calendar-day').forEach(day => {
            day.classList.remove('selected');
        });

        // Add selected class to clicked day
        element.classList.add('selected');

        // Fetch booked slots for this date and therapist, then show time slots
        fetchBookedSlots(selectedTherapistId, dateString);

        // Update hidden input
        document.getElementById('preferred_date').value = dateString;
    }

    function fetchBookedSlots(therapistId, dateString) {
        // Show loading indicator
        const timeSlotsGrid = document.getElementById('time-slots-grid');
        const placeholder = document.getElementById('time-slot-placeholder');
        const content = document.getElementById('time-slot-content');

        placeholder.style.display = 'none';
        content.style.display = 'block';
        timeSlotsGrid.innerHTML = '<div class="loading-slots"><i class="fa-solid fa-spinner fa-spin"></i> Loading available slots...</div>';

        fetch(`/api/therapists/${therapistId}/booked-slots/${dateString}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bookedSlots = data.booked_slots || [];
                    displayTimeSlots(dateString);
                } else {
                    console.error('Error fetching booked slots:', data.message);
                    bookedSlots = [];
                    displayTimeSlots(dateString);
                }
            })
            .catch(error => {
                console.error('Error fetching booked slots:', error);
                bookedSlots = [];
                displayTimeSlots(dateString);
            });
    }

    function displayTimeSlots(dateString) {
        const date = new Date(dateString);
        const dayName = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'][date.getDay()];
        const timeSlotsGrid = document.getElementById('time-slots-grid');
        const selectedDateDisplay = document.getElementById('selected-date-display');
        const placeholder = document.getElementById('time-slot-placeholder');
        const content = document.getElementById('time-slot-content');

        const dateFormatted = new Date(dateString).toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        selectedDateDisplay.textContent = dateFormatted;
        timeSlotsGrid.innerHTML = '';

        // Hide placeholder, show content
        placeholder.style.display = 'none';
        content.style.display = 'block';

        const schedules = therapistAvailability.weekly_schedule[dayName] || [];
        let availableSlotsCount = 0;
        let bookedSlotsCount = 0;

        schedules.forEach(schedule => {
            const startHour = parseInt(schedule.start_time.split(':')[0]);
            const endHour = parseInt(schedule.end_time.split(':')[0]);

            for (let hour = startHour; hour < endHour; hour++) {
                ['00', '30'].forEach(minute => {
                    const time = `${hour.toString().padStart(2, '0')}:${minute}:00`;
                    const timeSlot = document.createElement('div');
                    timeSlot.className = 'time-slot';

                    const displayTime = formatTime(time);

                    // Check if this time slot is already booked
                    const isBooked = bookedSlots.includes(time) || bookedSlots.includes(time.substring(0, 5));

                    if (isBooked) {
                        timeSlot.classList.add('booked');
                        timeSlot.innerHTML = `${displayTime} <span class="booked-label">Booked</span>`;
                        timeSlot.title = 'This time slot is already booked';
                        bookedSlotsCount++;
                    } else {
                        timeSlot.textContent = displayTime;
                        timeSlot.dataset.time = time;
                        availableSlotsCount++;

                        timeSlot.addEventListener('click', function() {
                            // Remove selected class from all slots
                            document.querySelectorAll('.time-slot').forEach(slot => {
                                slot.classList.remove('selected');
                            });
                            // Add selected class to this slot
                            this.classList.add('selected');
                            // Update hidden input with time (without seconds)
                            document.getElementById('preferred_time').value = time.substring(0, 5);
                        });
                    }

                    timeSlotsGrid.appendChild(timeSlot);
                });
            }
        });

        if (schedules.length === 0) {
            timeSlotsGrid.innerHTML = '<p class="text-muted">No time slots available for this day.</p>';
        } else if (availableSlotsCount === 0) {
            timeSlotsGrid.innerHTML = '<p class="text-muted"><i class="fa-solid fa-calendar-xmark"></i> All time slots are booked for this date. Please select another date.</p>';
        } else {
            // Add info message about availability
            const infoMsg = document.createElement('div');
            infoMsg.className = 'slots-info';
            infoMsg.innerHTML = `<i class="fa-solid fa-circle-info"></i> ${availableSlotsCount} available slot${availableSlotsCount !== 1 ? 's' : ''} ${bookedSlotsCount > 0 ? `(${bookedSlotsCount} already booked)` : ''}`;
            timeSlotsGrid.insertBefore(infoMsg, timeSlotsGrid.firstChild);
        }
    }

    function formatTime(time) {
        const [hours, minutes] = time.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const displayHour = hour % 12 || 12;
        return `${displayHour}:${minutes} ${ampm}`;
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    // Calendar navigation
    document.getElementById('prev-month')?.addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar();
    });

    document.getElementById('next-month')?.addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar();
    });

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

    // Form submission with AJAX and SweetAlert
    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        if (validateCurrentStep()) {
            // Show loading state
            const submitBtn = document.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Booking...';
            submitBtn.disabled = true;

            // Get form data
            const formData = new FormData(this);

            // Submit via AJAX
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Restore button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                if (data.success) {
                    // Show success popup
                    Swal.fire({
                        icon: 'success',
                        title: 'Appointment Booked Successfully!',
                        html: `
                            <div style="text-align: left; padding: 20px;">
                                <p style="font-size: 16px; margin-bottom: 15px;">Your appointment has been confirmed with the following details:</p>
                                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                                    <p style="margin: 8px 0;"><strong>Service:</strong> ${data.appointment.service_name || 'N/A'}</p>
                                    <p style="margin: 8px 0;"><strong>Therapist:</strong> ${data.appointment.therapist_name || 'N/A'}</p>
                                    <p style="margin: 8px 0;"><strong>Date:</strong> ${formatDate(data.appointment.preferred_date)}</p>
                                    <p style="margin: 8px 0;"><strong>Time:</strong> ${formatTime(data.appointment.preferred_time)}</p>
                                </div>
                                <p style="color: #7C9070; font-weight: 600;">We will contact you shortly to confirm your appointment.</p>
                            </div>
                        `,
                        confirmButtonText: 'Got it!',
                        confirmButtonColor: '#7C9070',
                        customClass: {
                            popup: 'swal-wide'
                        },
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Reset form
                            document.getElementById('appointmentForm').reset();

                            // Reset to first step
                            currentStep = 1;
                            updateStep();

                            // Clear selections
                            serviceCards.forEach(c => c.classList.remove('selected'));
                            therapistGroup.style.display = 'none';
                            document.querySelectorAll('.calendar-day').forEach(day => {
                                day.classList.remove('selected');
                            });

                            // Reset time slots
                            const placeholder = document.getElementById('time-slot-placeholder');
                            const content = document.getElementById('time-slot-content');
                            placeholder.style.display = 'flex';
                            content.style.display = 'none';
                        }
                    });
                } else {
                    // Show error popup
                    Swal.fire({
                        icon: 'error',
                        title: 'Booking Failed',
                        text: data.message || 'Something went wrong. Please try again.',
                        confirmButtonText: 'Okay',
                        confirmButtonColor: '#dc3545'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);

                // Restore button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                // Show error popup
                Swal.fire({
                    icon: 'error',
                    title: 'Booking Failed',
                    text: 'An error occurred while processing your request. Please try again.',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: '#dc3545'
                });
            });
        }
    });
});
</script>
@endpush