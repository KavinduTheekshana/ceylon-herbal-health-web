@extends('layouts.frontend')

@section('title', 'Privacy Policy - Ceylon Herbal Health')
@section('meta_description', 'Read our privacy policy to understand how we collect, use, and protect your personal information in compliance with GDPR and UK data protection laws.')

@section('content')
<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">Privacy Policy</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">privacy policy</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Privacy Policy Content Start -->
<div class="privacy-policy-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="privacy-policy-content">
                    <!-- Last Updated -->
                    <div class="policy-intro wow fadeInUp">
                        <p class="last-updated"><strong>Last Updated:</strong> {{ date('F d, Y') }}</p>
                        <p>At Ceylon Herbal Health, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, store, and protect your data in accordance with the General Data Protection Regulation (GDPR) and UK data protection laws.</p>
                    </div>

                    <!-- Section 1: Information We Collect -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="0.2s">
                        <h2>1. Information We Collect</h2>
                        <p>We collect and process the following types of personal information:</p>

                        <h3>1.1 Information You Provide Directly</h3>
                        <ul>
                            <li><strong>Contact Information:</strong> Name, email address, phone number, postal address</li>
                            <li><strong>Appointment Information:</strong> Preferred appointment dates, times, service selections, health-related information you choose to share</li>
                            <li><strong>Communication Data:</strong> Messages, inquiries, and correspondence you send to us</li>
                            <li><strong>Account Information:</strong> If you create an account, we collect username, password, and preferences</li>
                        </ul>

                        <h3>1.2 Information Collected Automatically</h3>
                        <ul>
                            <li><strong>Technical Data:</strong> IP address, browser type, device information, operating system</li>
                            <li><strong>Usage Data:</strong> Pages visited, time spent on pages, links clicked, referral sources</li>
                            <li><strong>Cookies:</strong> We use cookies to enhance your browsing experience (see our Cookie Policy below)</li>
                        </ul>
                    </div>

                    <!-- Section 2: How We Use Your Information -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="0.3s">
                        <h2>2. How We Use Your Information</h2>
                        <p>We process your personal data for the following purposes:</p>
                        <ul>
                            <li><strong>Service Delivery:</strong> To process and manage your appointments, consultations, and treatments</li>
                            <li><strong>Communication:</strong> To respond to your inquiries, send appointment confirmations, reminders, and follow-up care information</li>
                            <li><strong>Marketing:</strong> To send you newsletters, promotional offers, and health tips (only with your explicit consent)</li>
                            <li><strong>Website Improvement:</strong> To analyze website usage and improve our services</li>
                            <li><strong>Legal Compliance:</strong> To comply with legal obligations and protect our rights</li>
                            <li><strong>Safety and Security:</strong> To prevent fraud, abuse, and ensure the security of our services</li>
                        </ul>
                    </div>

                    <!-- Section 3: Legal Basis for Processing -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="0.4s">
                        <h2>3. Legal Basis for Processing (GDPR)</h2>
                        <p>Under GDPR, we process your personal data based on the following legal grounds:</p>
                        <ul>
                            <li><strong>Consent:</strong> You have given clear consent for us to process your data for specific purposes</li>
                            <li><strong>Contract:</strong> Processing is necessary to fulfill our contractual obligations to you</li>
                            <li><strong>Legal Obligation:</strong> Processing is necessary to comply with legal requirements</li>
                            <li><strong>Legitimate Interests:</strong> Processing is necessary for our legitimate business interests, provided your rights are not overridden</li>
                        </ul>
                    </div>

                    <!-- Section 4: Data Sharing and Disclosure -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="0.5s">
                        <h2>4. Data Sharing and Disclosure</h2>
                        <p>We do not sell your personal information. We may share your data with:</p>
                        <ul>
                            <li><strong>Service Providers:</strong> Third-party providers who assist with email services, payment processing, and website hosting</li>
                            <li><strong>Healthcare Professionals:</strong> When necessary for your treatment (only with your consent)</li>
                            <li><strong>Legal Authorities:</strong> When required by law or to protect our legal rights</li>
                            <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets</li>
                        </ul>
                        <p>All third parties are required to maintain the confidentiality and security of your information.</p>
                    </div>

                    <!-- Section 5: Data Retention -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="0.6s">
                        <h2>5. Data Retention</h2>
                        <p>We retain your personal information only for as long as necessary:</p>
                        <ul>
                            <li><strong>Appointment Records:</strong> 7 years (in accordance with healthcare record-keeping requirements)</li>
                            <li><strong>Marketing Data:</strong> Until you withdraw consent or request deletion</li>
                            <li><strong>Website Analytics:</strong> 26 months maximum</li>
                            <li><strong>Legal Requirements:</strong> As required by applicable laws and regulations</li>
                        </ul>
                    </div>

                    <!-- Section 6: Your Rights Under GDPR -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="0.7s">
                        <h2>6. Your Rights Under GDPR</h2>
                        <p>Under GDPR, you have the following rights:</p>
                        <ul>
                            <li><strong>Right to Access:</strong> Request copies of your personal data</li>
                            <li><strong>Right to Rectification:</strong> Request correction of inaccurate or incomplete data</li>
                            <li><strong>Right to Erasure:</strong> Request deletion of your personal data ("right to be forgotten")</li>
                            <li><strong>Right to Restrict Processing:</strong> Request limitation of how we use your data</li>
                            <li><strong>Right to Data Portability:</strong> Request transfer of your data to another service</li>
                            <li><strong>Right to Object:</strong> Object to processing based on legitimate interests or direct marketing</li>
                            <li><strong>Right to Withdraw Consent:</strong> Withdraw consent at any time (without affecting prior processing)</li>
                            <li><strong>Right to Lodge a Complaint:</strong> File a complaint with the Information Commissioner's Office (ICO)</li>
                        </ul>
                        <p>To exercise any of these rights, please contact us at: <a href="mailto:privacy@ceylonherbalhealth.co.uk">privacy@ceylonherbalhealth.co.uk</a></p>
                    </div>

                    <!-- Section 7: Cookies -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="0.8s">
                        <h2>7. Cookies and Tracking Technologies</h2>
                        <p>We use cookies to enhance your experience on our website:</p>

                        <h3>7.1 Types of Cookies We Use</h3>
                        <ul>
                            <li><strong>Essential Cookies:</strong> Necessary for website functionality</li>
                            <li><strong>Analytics Cookies:</strong> Help us understand how visitors use our site</li>
                            <li><strong>Marketing Cookies:</strong> Used to display relevant advertisements (only with consent)</li>
                        </ul>

                        <h3>7.2 Managing Cookies</h3>
                        <p>You can control cookies through your browser settings. Note that disabling certain cookies may affect website functionality.</p>
                    </div>

                    <!-- Section 8: Data Security -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="0.9s">
                        <h2>8. Data Security</h2>
                        <p>We implement appropriate technical and organizational measures to protect your data:</p>
                        <ul>
                            <li>SSL/TLS encryption for data transmission</li>
                            <li>Secure servers with restricted access</li>
                            <li>Regular security assessments and updates</li>
                            <li>Staff training on data protection and confidentiality</li>
                            <li>Access controls and authentication measures</li>
                        </ul>
                        <p>While we take all reasonable precautions, no method of transmission over the internet is 100% secure.</p>
                    </div>

                    <!-- Section 9: International Transfers -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="1s">
                        <h2>9. International Data Transfers</h2>
                        <p>Your data is primarily stored and processed in the United Kingdom. If we transfer data outside the UK/EEA, we ensure adequate safeguards are in place, such as:</p>
                        <ul>
                            <li>EU-approved standard contractual clauses</li>
                            <li>Adequacy decisions by the European Commission</li>
                            <li>Other legally approved transfer mechanisms</li>
                        </ul>
                    </div>

                    <!-- Section 10: Children's Privacy -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="1.1s">
                        <h2>10. Children's Privacy</h2>
                        <p>Our services are not directed at children under 16. We do not knowingly collect personal information from children under 16 without parental consent. If you believe we have collected data from a child, please contact us immediately.</p>
                    </div>

                    <!-- Section 11: Changes to Privacy Policy -->
                    <div class="policy-section wow fadeInUp" data-wow-delay="1.2s">
                        <h2>11. Changes to This Privacy Policy</h2>
                        <p>We may update this Privacy Policy from time to time. We will notify you of significant changes by:</p>
                        <ul>
                            <li>Posting the updated policy on our website with a new "Last Updated" date</li>
                            <li>Sending you an email notification (if you have provided your email)</li>
                        </ul>
                        <p>Continued use of our services after changes constitutes acceptance of the updated policy.</p>
                    </div>

                    <!-- Section 12: Contact Us -->
                    <div class="policy-section contact-section wow fadeInUp" data-wow-delay="1.3s">
                        <h2>12. Contact Us</h2>
                        <p>If you have any questions, concerns, or requests regarding this Privacy Policy or your personal data, please contact us:</p>
                        <div class="contact-details">
                            <p><strong>Ceylon Herbal Health</strong></p>
                            <p><strong>Email:</strong> <a href="mailto:privacy@ceylonherbalhealth.co.uk">privacy@ceylonherbalhealth.co.uk</a></p>
                            <p><strong>Phone:</strong> <a href="tel:+447349925427">+44 73 499 25427</a></p>
                            <p><strong>Data Protection Officer:</strong> Available upon request</p>
                        </div>

                        <div class="regulatory-info">
                            <p><strong>Regulatory Authority:</strong></p>
                            <p>If you believe your data protection rights have been violated, you may lodge a complaint with:</p>
                            <p><strong>Information Commissioner's Office (ICO)</strong><br>
                            Wycliffe House, Water Lane<br>
                            Wilmslow, Cheshire SK9 5AF<br>
                            Website: <a href="https://ico.org.uk" target="_blank" rel="noopener noreferrer">ico.org.uk</a><br>
                            Phone: 0303 123 1113</p>
                        </div>
                    </div>

                    <!-- Back to Home Button -->
                    <div class="policy-cta wow fadeInUp" data-wow-delay="1.4s">
                        <a href="{{ route('home') }}" class="btn-default">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Privacy Policy Content End -->
@endsection

@push('styles')
<style>
/* Privacy Policy Custom Styles */
.privacy-policy-section {
    padding: 80px 0;
    background-color: var(--white-color);
}

.privacy-policy-content {
    max-width: 1000px;
    margin: 0 auto;
}

.policy-intro {
    margin-bottom: 50px;
    padding: 30px;
    background-color: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid var(--accent-color);
}

.policy-intro .last-updated {
    color: var(--accent-secondary-color);
    font-size: 14px;
    margin-bottom: 15px;
}

.policy-section {
    margin-bottom: 40px;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.policy-section h2 {
    color: var(--accent-color);
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--accent-secondary-color);
}

.policy-section h3 {
    color: var(--heading-color);
    font-size: 20px;
    font-weight: 600;
    margin-top: 25px;
    margin-bottom: 15px;
}

.policy-section p {
    color: var(--body-color);
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 15px;
}

.policy-section ul {
    margin: 15px 0;
    padding-left: 20px;
}

.policy-section ul li {
    color: var(--body-color);
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 10px;
    list-style: none;
    position: relative;
    padding-left: 25px;
}

.policy-section ul li:before {
    content: "\f00c";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    left: 0;
    color: var(--accent-secondary-color);
    font-size: 14px;
}

.policy-section a {
    color: var(--accent-color);
    text-decoration: none;
    transition: color 0.3s ease;
}

.policy-section a:hover {
    color: var(--accent-secondary-color);
    text-decoration: underline;
}

.contact-section .contact-details,
.contact-section .regulatory-info {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-top: 20px;
}

.contact-section .regulatory-info {
    margin-top: 30px;
    border-left: 4px solid var(--accent-secondary-color);
}

.policy-cta {
    text-align: center;
    margin-top: 50px;
    padding-top: 30px;
    border-top: 2px solid #e9ecef;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .privacy-policy-section {
        padding: 50px 0;
    }

    .policy-section h2 {
        font-size: 24px;
    }

    .policy-section h3 {
        font-size: 18px;
    }

    .policy-section p,
    .policy-section ul li {
        font-size: 15px;
    }

    .policy-intro,
    .policy-section {
        padding: 20px;
    }
}
</style>
@endpush
