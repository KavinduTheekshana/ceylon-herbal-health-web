@extends('layouts.frontend')

@section('title', 'Contact Us - Get in Touch')
@section('meta_description', 'Contact us for inquiries about our Ayurvedic treatments and wellness services. We\'re here to help you on your journey to better health.')

@section('content')
    <!-- Display Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show contact-alert" role="alert">
            <div class="container">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show contact-alert" role="alert">
            <div class="container">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show contact-alert" role="alert">
            <div class="container">
                <strong>Please correct the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @include('frontend.contact.pageHeader')
    @include('frontend.contact.contactUs')
    @include('frontend.contact.googleMap')
@endsection

@push('styles')
<style>
/* Contact Form Validation Styles */
.contact-form .form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.contact-form .invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
    font-weight: 500;
}

/* Alert Styles */
.contact-alert {
    margin: 0;
    border-radius: 0;
    border: none;
    padding: 15px 0;
    z-index: 1050;
    position: relative;
}

.contact-alert.alert-success {
    background-color: #d4edda;
    color: #155724;
    border-bottom: 3px solid #28a745;
}

.contact-alert.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border-bottom: 3px solid #dc3545;
}

.contact-alert ul {
    padding-left: 20px;
}

.contact-alert .btn-close {
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    padding: 0;
    margin: 0;
    background: none;
    border: none;
    font-size: 1.2rem;
    opacity: 0.7;
}

.contact-alert .btn-close:hover {
    opacity: 1;
}

/* Button Loading State */
.btn-default {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-default:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-default.loading .btn-text {
    opacity: 0;
}

.btn-default.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Responsive improvements */
@media (max-width: 768px) {
    .contact-alert {
        padding: 10px 0;
        font-size: 0.9rem;
    }
    
    .contact-alert .btn-close {
        right: 15px;
        font-size: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Contact Form Enhancement
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('contactSubmitBtn');
    
    if (contactForm && submitBtn) {
        contactForm.addEventListener('submit', function(e) {
            // Add loading state to submit button
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
            
            // Remove any existing validation classes
            const invalidInputs = contactForm.querySelectorAll('.is-invalid');
            invalidInputs.forEach(input => {
                input.classList.remove('is-invalid');
            });
            
            // Client-side validation
            let isValid = true;
            const requiredFields = contactForm.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                }
            });
            
            // Email validation
            const emailField = contactForm.querySelector('#email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailField && emailField.value && !emailRegex.test(emailField.value)) {
                emailField.classList.add('is-invalid');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                
                // Scroll to first invalid field
                const firstInvalid = contactForm.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
                return;
            }
            
            // Re-enable button after timeout if form submission fails
            setTimeout(() => {
                if (submitBtn.disabled) {
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                }
            }, 15000);
        });
        
        // Remove validation classes on input
        const formInputs = contactForm.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    }
    
    // Auto-hide alerts after 8 seconds
    const alerts = document.querySelectorAll('.contact-alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert && alert.parentNode) {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.remove();
                    }
                }, 500);
            }
        }, 8000);
    });
    
    // Smooth scroll to form if there are validation errors
    if (document.querySelector('.contact-alert.alert-danger')) {
        setTimeout(() => {
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 100);
    }
});
</script>
@endpush