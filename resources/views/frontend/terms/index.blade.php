@extends('layouts.frontend')

@section('title', 'Terms & Conditions - Ceylon Herbal Health')
@section('meta_description', 'Read our terms and conditions to understand the rules and guidelines for using our services and website.')

@section('content')
<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">Terms & Conditions</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">terms & conditions</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Terms & Conditions Content Start -->
<div class="terms-conditions-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="terms-conditions-content">
                    <!-- Last Updated -->
                    <div class="terms-intro wow fadeInUp">
                        <p class="last-updated"><strong>Last Updated:</strong> {{ date('F d, Y') }}</p>
                        <p>Welcome to Ceylon Herbal Health. These Terms and Conditions govern your use of our website and services. By accessing or using our website and services, you agree to be bound by these terms. Please read them carefully.</p>
                    </div>

                    <!-- Section 1: Definitions -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="0.2s">
                        <h2>1. Definitions</h2>
                        <ul>
                            <li><strong>"We," "Us," "Our"</strong> refers to Ceylon Herbal Health</li>
                            <li><strong>"You," "Your"</strong> refers to the user or customer of our services</li>
                            <li><strong>"Services"</strong> refers to all Ayurvedic treatments, consultations, and wellness services we provide</li>
                            <li><strong>"Website"</strong> refers to www.ceylonherbalhealth.co.uk and all associated pages</li>
                            <li><strong>"Content"</strong> refers to all text, images, videos, and materials on our website</li>
                        </ul>
                    </div>

                    <!-- Section 2: Acceptance of Terms -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="0.3s">
                        <h2>2. Acceptance of Terms</h2>
                        <p>By accessing our website or using our services, you confirm that:</p>
                        <ul>
                            <li>You are at least 18 years of age or have parental/guardian consent</li>
                            <li>You have the legal capacity to enter into a binding agreement</li>
                            <li>You agree to comply with all applicable laws and regulations</li>
                            <li>All information you provide is accurate and truthful</li>
                        </ul>
                        <p>If you do not agree with these terms, please do not use our website or services.</p>
                    </div>

                    <!-- Section 3: Services Provided -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="0.4s">
                        <h2>3. Services Provided</h2>

                        <h3>3.1 Ayurvedic Treatments and Consultations</h3>
                        <p>We offer traditional Ayurvedic treatments and consultations. Our services are complementary and should not replace conventional medical advice or treatment.</p>

                        <h3>3.2 Appointment Booking</h3>
                        <ul>
                            <li>Appointments can be booked through our website, phone, or email</li>
                            <li>Appointments are subject to availability and confirmation</li>
                            <li>We reserve the right to refuse service to anyone for any lawful reason</li>
                        </ul>

                        <h3>3.3 Treatment Disclaimer</h3>
                        <p><strong>Important:</strong> Our Ayurvedic treatments are holistic wellness services and are not intended to diagnose, treat, cure, or prevent any disease. We are not licensed medical practitioners. You should consult with a qualified healthcare provider for any medical conditions.</p>
                    </div>

                    <!-- Section 4: Booking and Cancellation Policy -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="0.5s">
                        <h2>4. Booking and Cancellation Policy</h2>

                        <h3>4.1 Booking Confirmation</h3>
                        <ul>
                            <li>All bookings are subject to availability</li>
                            <li>A confirmation email will be sent upon successful booking</li>
                            <li>Please arrive 10 minutes before your scheduled appointment</li>
                        </ul>

                        <h3>4.2 Cancellation and Rescheduling</h3>
                        <ul>
                            <li>You may cancel or reschedule appointments at least 24 hours in advance</li>
                            <li>Cancellations with less than 24 hours notice may incur a cancellation fee</li>
                            <li>No-shows may be charged the full appointment fee</li>
                            <li>To cancel or reschedule, contact us at +44 73 499 25427 or info@ceylonherbalhealth.co.uk</li>
                        </ul>

                        <h3>4.3 Late Arrivals</h3>
                        <p>If you arrive late, we will do our best to accommodate you, but your appointment time may be shortened to avoid delays for other clients. Full charges will still apply.</p>
                    </div>

                    <!-- Section 5: Payment Terms -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="0.6s">
                        <h2>5. Payment Terms</h2>

                        <h3>5.1 Pricing</h3>
                        <ul>
                            <li>All prices are listed in British Pounds (GBP)</li>
                            <li>Prices are subject to change without notice</li>
                            <li>Current prices will apply at the time of booking</li>
                        </ul>

                        <h3>5.2 Payment Methods</h3>
                        <ul>
                            <li>We accept cash, credit/debit cards, and bank transfers</li>
                            <li>Payment is due at the time of service unless otherwise arranged</li>
                            <li>For package deals, full payment may be required upfront</li>
                        </ul>

                        <h3>5.3 Refund Policy</h3>
                        <ul>
                            <li>Refunds are provided on a case-by-case basis</li>
                            <li>Service fees for completed appointments are non-refundable</li>
                            <li>Prepaid packages may be refunded for unused sessions (minus cancellation fees)</li>
                            <li>Refund requests must be made in writing within 14 days</li>
                        </ul>
                    </div>

                    <!-- Section 6: Health and Safety -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="0.7s">
                        <h2>6. Health and Safety</h2>

                        <h3>6.1 Health Disclosure</h3>
                        <p>You must disclose all relevant health information, including:</p>
                        <ul>
                            <li>Medical conditions and illnesses</li>
                            <li>Current medications and supplements</li>
                            <li>Allergies and sensitivities</li>
                            <li>Pregnancy or breastfeeding status</li>
                            <li>Recent surgeries or injuries</li>
                        </ul>

                        <h3>6.2 Contraindications</h3>
                        <p>Certain treatments may not be suitable for everyone. We reserve the right to refuse or modify treatments based on your health status.</p>

                        <h3>6.3 Your Responsibility</h3>
                        <ul>
                            <li>Inform us immediately if you feel any discomfort during treatment</li>
                            <li>Follow all aftercare instructions provided</li>
                            <li>Consult your doctor if you have any concerns about our treatments</li>
                            <li>You are responsible for any adverse reactions resulting from undisclosed health conditions</li>
                        </ul>

                        <h3>6.4 COVID-19 and Infectious Diseases</h3>
                        <p>We maintain high hygiene standards. If you have symptoms of any infectious disease, please reschedule your appointment.</p>
                    </div>

                    <!-- Section 7: Liability and Insurance -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="0.8s">
                        <h2>7. Limitation of Liability</h2>

                        <h3>7.1 Service Disclaimer</h3>
                        <p>Our services are provided on an "as is" basis. We make no warranties or guarantees regarding outcomes or results.</p>

                        <h3>7.2 Limitation of Liability</h3>
                        <p>To the fullest extent permitted by law, Ceylon Herbal Health shall not be liable for:</p>
                        <ul>
                            <li>Any indirect, incidental, or consequential damages</li>
                            <li>Loss of income, profits, or business opportunities</li>
                            <li>Damages arising from undisclosed health conditions</li>
                            <li>Results that do not meet your expectations</li>
                        </ul>

                        <h3>7.3 Maximum Liability</h3>
                        <p>Our total liability for any claim shall not exceed the amount you paid for the service in question.</p>

                        <h3>7.4 Insurance</h3>
                        <p>We maintain appropriate professional liability insurance. Details available upon request.</p>
                    </div>

                    <!-- Section 8: Intellectual Property -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="0.9s">
                        <h2>8. Intellectual Property Rights</h2>

                        <h3>8.1 Website Content</h3>
                        <p>All content on our website, including text, images, logos, videos, and graphics, is owned by or licensed to Ceylon Herbal Health and protected by copyright laws.</p>

                        <h3>8.2 Permitted Use</h3>
                        <ul>
                            <li>You may view and download content for personal, non-commercial use only</li>
                            <li>You may not reproduce, distribute, modify, or create derivative works without written permission</li>
                            <li>You may not use our content for commercial purposes</li>
                        </ul>

                        <h3>8.3 Trademarks</h3>
                        <p>Ceylon Herbal Health name and logo are trademarks. Unauthorized use is prohibited.</p>
                    </div>

                    <!-- Section 9: User Conduct -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="1s">
                        <h2>9. User Conduct and Prohibited Activities</h2>
                        <p>When using our website or services, you agree not to:</p>
                        <ul>
                            <li>Violate any applicable laws or regulations</li>
                            <li>Infringe on intellectual property rights</li>
                            <li>Transmit viruses, malware, or harmful code</li>
                            <li>Attempt to gain unauthorized access to our systems</li>
                            <li>Harass, abuse, or harm our staff or other clients</li>
                            <li>Use our services for any unlawful or fraudulent purpose</li>
                            <li>Impersonate any person or entity</li>
                            <li>Collect or harvest personal data of other users</li>
                        </ul>
                    </div>

                    <!-- Section 10: Privacy and Data Protection -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="1.1s">
                        <h2>10. Privacy and Data Protection</h2>
                        <p>Your use of our services is also governed by our <a href="{{ route('privacy') }}">Privacy Policy</a>, which explains how we collect, use, and protect your personal information in compliance with GDPR.</p>
                        <p>By using our services, you consent to our collection and use of your data as described in our Privacy Policy.</p>
                    </div>

                    <!-- Section 11: Website Use -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="1.2s">
                        <h2>11. Website Use and Availability</h2>

                        <h3>11.1 Access</h3>
                        <ul>
                            <li>We strive to keep our website available 24/7 but cannot guarantee uninterrupted access</li>
                            <li>We may suspend access for maintenance or updates without prior notice</li>
                            <li>We are not liable for any downtime or technical issues</li>
                        </ul>

                        <h3>11.2 Third-Party Links</h3>
                        <p>Our website may contain links to third-party websites. We are not responsible for their content, privacy practices, or terms of use.</p>

                        <h3>11.3 User Accounts</h3>
                        <ul>
                            <li>You are responsible for maintaining the confidentiality of your account credentials</li>
                            <li>You are responsible for all activities under your account</li>
                            <li>Notify us immediately of any unauthorized use</li>
                        </ul>
                    </div>

                    <!-- Section 12: Communication -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="1.3s">
                        <h2>12. Communication and Marketing</h2>

                        <h3>12.1 Electronic Communications</h3>
                        <p>By providing your email or phone number, you consent to receive:</p>
                        <ul>
                            <li>Appointment confirmations and reminders</li>
                            <li>Service-related communications</li>
                            <li>Updates about our services</li>
                        </ul>

                        <h3>12.2 Marketing Communications</h3>
                        <p>You may opt-in to receive newsletters and promotional materials. You can unsubscribe at any time by:</p>
                        <ul>
                            <li>Clicking the unsubscribe link in our emails</li>
                            <li>Contacting us at info@ceylonherbalhealth.co.uk</li>
                        </ul>
                    </div>

                    <!-- Section 13: Force Majeure -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="1.4s">
                        <h2>13. Force Majeure</h2>
                        <p>We shall not be liable for any failure to perform our obligations due to circumstances beyond our reasonable control, including:</p>
                        <ul>
                            <li>Natural disasters, pandemics, or public health emergencies</li>
                            <li>War, terrorism, or civil unrest</li>
                            <li>Government actions or regulations</li>
                            <li>Power outages, internet failures, or technical issues</li>
                            <li>Strikes or labor disputes</li>
                        </ul>
                    </div>

                    <!-- Section 14: Dispute Resolution -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="1.5s">
                        <h2>14. Dispute Resolution and Governing Law</h2>

                        <h3>14.1 Governing Law</h3>
                        <p>These Terms and Conditions are governed by the laws of England and Wales.</p>

                        <h3>14.2 Dispute Resolution</h3>
                        <p>In case of any disputes, we encourage you to contact us first to resolve the matter amicably. If resolution cannot be reached:</p>
                        <ul>
                            <li>Disputes shall be resolved through mediation or arbitration</li>
                            <li>Legal proceedings shall be conducted in the courts of England and Wales</li>
                        </ul>

                        <h3>14.3 Consumer Rights</h3>
                        <p>Nothing in these terms affects your statutory rights as a consumer under UK law.</p>
                    </div>

                    <!-- Section 15: Changes to Terms -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="1.6s">
                        <h2>15. Changes to Terms and Conditions</h2>
                        <p>We reserve the right to modify these Terms and Conditions at any time. Changes will be effective immediately upon posting on our website. We will indicate the "Last Updated" date at the top of this page.</p>
                        <p>Your continued use of our services after changes constitutes acceptance of the modified terms.</p>
                        <p>We recommend reviewing these terms periodically to stay informed of any updates.</p>
                    </div>

                    <!-- Section 16: Severability -->
                    <div class="terms-section wow fadeInUp" data-wow-delay="1.7s">
                        <h2>16. Severability and Waiver</h2>

                        <h3>16.1 Severability</h3>
                        <p>If any provision of these terms is found to be invalid or unenforceable, the remaining provisions shall continue in full force and effect.</p>

                        <h3>16.2 Waiver</h3>
                        <p>Our failure to enforce any right or provision shall not constitute a waiver of that right or provision.</p>
                    </div>

                    <!-- Section 17: Contact Information -->
                    <div class="terms-section contact-section wow fadeInUp" data-wow-delay="1.8s">
                        <h2>17. Contact Information</h2>
                        <p>If you have any questions or concerns about these Terms and Conditions, please contact us:</p>
                        <div class="contact-details">
                            <p><strong>Ceylon Herbal Health</strong></p>
                            <p><strong>Email:</strong> <a href="mailto:info@ceylonherbalhealth.co.uk">info@ceylonherbalhealth.co.uk</a></p>
                            <p><strong>Phone:</strong> <a href="tel:+447349925427">+44 73 499 25427</a></p>
                            <p><strong>Business Hours:</strong> Monday - Saturday, 9:00 AM - 9:00 PM</p>
                        </div>
                    </div>

                    <!-- Acknowledgment -->
                    <div class="terms-section acknowledgment-section wow fadeInUp" data-wow-delay="1.9s">
                        <h2>Acknowledgment</h2>
                        <p>By using our website and services, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions.</p>
                        <p class="acknowledgment-highlight">Thank you for choosing Ceylon Herbal Health for your wellness journey. We look forward to serving you!</p>
                    </div>

                    <!-- Back to Home Button -->
                    <div class="terms-cta wow fadeInUp" data-wow-delay="2s">
                        <a href="{{ route('home') }}" class="btn-default">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Terms & Conditions Content End -->
@endsection

@push('styles')
<style>
/* Terms & Conditions Custom Styles */
.terms-conditions-section {
    padding: 80px 0;
    background-color: var(--white-color);
}

.terms-conditions-content {
    max-width: 1000px;
    margin: 0 auto;
}

.terms-intro {
    margin-bottom: 50px;
    padding: 30px;
    background-color: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid var(--accent-color);
}

.terms-intro .last-updated {
    color: var(--accent-secondary-color);
    font-size: 14px;
    margin-bottom: 15px;
}

.terms-section {
    margin-bottom: 40px;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.terms-section h2 {
    color: var(--accent-color);
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--accent-secondary-color);
}

.terms-section h3 {
    color: var(--heading-color);
    font-size: 20px;
    font-weight: 600;
    margin-top: 25px;
    margin-bottom: 15px;
}

.terms-section p {
    color: var(--body-color);
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 15px;
}

.terms-section ul {
    margin: 15px 0;
    padding-left: 20px;
}

.terms-section ul li {
    color: var(--body-color);
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 10px;
    list-style: none;
    position: relative;
    padding-left: 25px;
}

.terms-section ul li:before {
    content: "\f00c";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    left: 0;
    color: var(--accent-secondary-color);
    font-size: 14px;
}

.terms-section a {
    color: var(--accent-color);
    text-decoration: none;
    transition: color 0.3s ease;
}

.terms-section a:hover {
    color: var(--accent-secondary-color);
    text-decoration: underline;
}

.contact-section .contact-details {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-top: 20px;
}

.acknowledgment-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 2px solid var(--accent-secondary-color);
}

.acknowledgment-highlight {
    font-weight: 600;
    color: var(--accent-color);
    font-size: 17px;
    margin-top: 20px;
    padding: 15px;
    background-color: rgba(255, 255, 255, 0.7);
    border-radius: 5px;
    text-align: center;
}

.terms-cta {
    text-align: center;
    margin-top: 50px;
    padding-top: 30px;
    border-top: 2px solid #e9ecef;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .terms-conditions-section {
        padding: 50px 0;
    }

    .terms-section h2 {
        font-size: 24px;
    }

    .terms-section h3 {
        font-size: 18px;
    }

    .terms-section p,
    .terms-section ul li {
        font-size: 15px;
    }

    .terms-intro,
    .terms-section {
        padding: 20px;
    }
}
</style>
@endpush
