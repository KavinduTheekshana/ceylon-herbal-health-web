@extends('layouts.frontend')

@section('title', 'Appointment Submitted Successfully')

@section('content')
<div class="appointment-success-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Message Box -->
                <div class="success-message-box wow fadeInUp">
                    <!-- Success Icon -->
                    <div class="success-icon">
                        <div class="checkmark-circle">
                            <div class="checkmark"></div>
                        </div>
                    </div>

                    <!-- Success Content -->
                    <div class="success-content">
                        <h1>Appointment Request Submitted!</h1>
                        <p class="lead">Thank you for choosing Ceylon Herbal Health. Your appointment request has been successfully submitted.</p>
                        
                        @if(session('appointment'))
                        @php $appointment = session('appointment'); @endphp
                        <div class="appointment-summary">
                            <h3>📋 Your Appointment Details</h3>
                            <div class="appointment-info">
                                <div class="info-item">
                                    <strong>Service:</strong> 
                                    <span>{{ $appointment->service->title ?? 'Selected Service' }}</span>
                                </div>
                                <div class="info-item">
                                    <strong>Date:</strong> 
                                    <span>{{ $appointment->preferred_date->format('l, F j, Y') }}</span>
                                </div>
                                <div class="info-item">
                                    <strong>Time:</strong> 
                                    <span>{{ \Carbon\Carbon::parse($appointment->preferred_time)->format('g:i A') }}</span>
                                </div>
                                <div class="info-item">
                                    <strong>Status:</strong> 
                                    <span class="status-badge">{{ ucfirst($appointment->status) }}</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- What Happens Next -->
                        <div class="next-steps">
                            <h3>📞 What Happens Next?</h3>
                            <div class="steps-list">
                                <div class="step-item">
                                    <div class="step-number">1</div>
                                    <div class="step-content">
                                        <h4>Review Process</h4>
                                        <p>Our team will review your appointment request immediately</p>
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">2</div>
                                    <div class="step-content">
                                        <h4>Confirmation Call</h4>
                                        <p>We'll call you within <strong>2 hours</strong> to confirm your appointment</p>
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">3</div>
                                    <div class="step-content">
                                        <h4>Email Confirmation</h4>
                                        <p>You'll receive a detailed confirmation email once approved</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Important Notes -->
                        <div class="important-notes">
                            <h3>📋 Important Notes</h3>
                            <ul>
                                <li>Please ensure your phone is accessible for our confirmation call</li>
                                <li>Check your email (including spam folder) for confirmation details</li>
                                <li>Arrive 10 minutes early for your appointment</li>
                                <li>Bring any relevant medical documents or previous test results</li>
                            </ul>
                        </div>

                        <!-- Contact Options -->
                        <div class="contact-options">
                            <h3>💬 Need Immediate Assistance?</h3>
                            <div class="contact-buttons">
                                <a href="tel:+447349925427" class="contact-btn phone-btn">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>
                                        <strong>Call Us Now</strong><br>
                                        +44 73 499 25427
                                    </span>
                                </a>
                                <a href="https://wa.me/447349925427?text=Hi! I just submitted an appointment request and have a question." class="contact-btn whatsapp-btn" target="_blank">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <span>
                                        <strong>WhatsApp</strong><br>
                                        Chat Now
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('home') }}" class="btn-primary">
                                <i class="fa-solid fa-home"></i> Return to Home
                            </a>
                            <a href="{{ route('services.index') }}" class="btn-secondary">
                                <i class="fa-solid fa-leaf"></i> View Our Services
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.appointment-success-page {
    padding: 100px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 80vh;
}

.success-message-box {
    background: white;
    border-radius: 30px;
    padding: 50px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.success-message-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--accent-color), var(--accent-secondary-color));
}

.success-icon {
    margin-bottom: 30px;
}

.checkmark-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent-color), var(--accent-secondary-color));
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    animation: scaleIn 0.6s ease-out;
}

@keyframes scaleIn {
    0% { transform: scale(0); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.checkmark {
    width: 40px;
    height: 20px;
    border: solid white;
    border-width: 0 0 4px 4px;
    transform: rotate(-45deg);
    animation: checkmarkDraw 0.3s ease-out 0.3s both;
}

@keyframes checkmarkDraw {
    0% { width: 0; height: 0; }
    50% { width: 40px; height: 0; }
    100% { width: 40px; height: 20px; }
}

.success-content h1 {
    font-size: 32px;
    color: var(--primary-color);
    margin-bottom: 15px;
    font-weight: 600;
}

.lead {
    font-size: 18px;
    color: var(--text-color);
    margin-bottom: 40px;
}

.appointment-summary {
    background: var(--secondary-color);
    border-radius: 15px;
    padding: 30px;
    margin: 30px 0;
    text-align: left;
}

.appointment-summary h3 {
    color: var(--primary-color);
    margin-bottom: 20px;
    text-align: center;
}

.appointment-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid var(--divider-color);
}

.info-item:last-child {
    border-bottom: none;
}

.info-item strong {
    color: var(--primary-color);
    min-width: 80px;
}

.status-badge {
    background: #fff3cd;
    color: #856404;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.next-steps {
    text-align: left;
    margin: 40px 0;
}

.next-steps h3 {
    color: var(--primary-color);
    margin-bottom: 25px;
    text-align: center;
}

.steps-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.step-item {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 20px;
    background: white;
    border: 1px solid var(--divider-color);
    border-radius: 15px;
    transition: all 0.3s ease;
}

.step-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.step-number {
    width: 40px;
    height: 40px;
    background: var(--accent-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    flex-shrink: 0;
}

.step-content h4 {
    color: var(--primary-color);
    margin-bottom: 5px;
}

.step-content p {
    color: var(--text-color);
    margin: 0;
}

.important-notes {
    text-align: left;
    margin: 40px 0;
    background: #e8f5e8;
    padding: 25px;
    border-radius: 15px;
}

.important-notes h3 {
    color: var(--primary-color);
    margin-bottom: 15px;
    text-align: center;
}

.important-notes ul {
    list-style: none;
    padding: 0;
}

.important-notes li {
    padding: 8px 0;
    position: relative;
    padding-left: 25px;
    color: var(--text-color);
}

.important-notes li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--accent-color);
    font-weight: bold;
}

.contact-options {
    margin: 40px 0;
}

.contact-options h3 {
    color: var(--primary-color);
    margin-bottom: 20px;
}

.contact-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.contact-btn {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 25px;
    border-radius: 15px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    flex: 1;
    max-width: 250px;
}

.phone-btn {
    background: var(--primary-color);
    color: white;
}

.whatsapp-btn {
    background: var(--accent-color);
    color: white;
}

.contact-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    text-decoration: none;
    color: white;
}

.contact-btn i {
    font-size: 20px;
}

.action-buttons {
    margin-top: 40px;
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn-primary, .btn-secondary {
    padding: 15px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
}

.btn-secondary {
    background: transparent;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
}

.btn-primary:hover, .btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    text-decoration: none;
}

.btn-primary:hover {
    color: white;
}

.btn-secondary:hover {
    background: var(--primary-color);
    color: white;
}

@media (max-width: 768px) {
    .success-message-box {
        padding: 30px 20px;
    }
    
    .appointment-info {
        grid-template-columns: 1fr;
    }
    
    .contact-buttons {
        flex-direction: column;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .steps-list {
        gap: 15px;
    }
    
    .step-item {
        padding: 15px;
    }
}
</style>
@endsection