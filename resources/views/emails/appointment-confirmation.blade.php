<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation - Ceylon Herbal Health</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .email-header {
            background: linear-gradient(135deg, #3D493A, #AEA17E);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .email-body {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #3D493A;
        }
        
        .confirmation-box {
            background-color: #f8f9fa;
            border-left: 4px solid #3D493A;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .appointment-details {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: bold;
            color: #3D493A;
            min-width: 130px;
        }
        
        .detail-value {
            color: #333;
            text-align: right;
            flex: 1;
        }
        
        .status-badge {
            background-color: #fff3cd;
            color: #856404;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .contact-info {
            background-color: #e8f5e8;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        
        .contact-info h4 {
            color: #3D493A;
            margin-bottom: 15px;
        }
        
        .contact-item {
            margin-bottom: 10px;
        }
        
        .contact-item strong {
            color: #3D493A;
        }
        
        .cta-buttons {
            text-align: center;
            margin: 30px 0;
        }
        
        .cta-button {
            display: inline-block;
            background-color: #3D493A;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 25px;
            margin: 10px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .cta-button.whatsapp {
            background-color: #25D366;
        }
        
        .email-footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        
        .footer-links {
            margin-top: 15px;
        }
        
        .footer-links a {
            color: #3D493A;
            text-decoration: none;
            margin: 0 10px;
        }
        
        @media (max-width: 600px) {
            .email-body {
                padding: 20px 15px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .detail-value {
                text-align: left;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="logo">🌿 Ceylon Herbal Health</div>
            <p>Authentic Sri Lankan Ayurveda</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <h2 class="greeting">Dear {{ $appointment->name }},</h2>
            
            <p>Thank you for booking an appointment with Ceylon Herbal Health. We have received your appointment request and our team will review it shortly.</p>
            
            <div class="confirmation-box">
                <h3 style="color: #3D493A; margin-bottom: 10px;">✅ Appointment Request Received</h3>
                <p style="margin: 0;">Your appointment request has been successfully submitted. We will contact you within <strong>2 hours</strong> to confirm your appointment.</p>
            </div>

            <!-- Appointment Details -->
            <div class="appointment-details">
                <h3 style="color: #3D493A; margin-bottom: 20px; text-align: center;">📋 Appointment Details</h3>
                
                <div class="detail-row">
                    <span class="detail-label">Service:</span>
                    <span class="detail-value">{{ $service->title ?? 'Service' }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Date:</span>
                    <span class="detail-value">{{ $appointment->preferred_date->format('l, F j, Y') }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Time:</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($appointment->preferred_time)->format('g:i A') }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Practitioner:</span>
                    <span class="detail-value">{{ $appointment->practitioner_name }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value">
                        <span class="status-badge">{{ ucfirst($appointment->status) }}</span>
                    </span>
                </div>

                @if($appointment->message)
                <div class="detail-row">
                    <span class="detail-label">Your Message:</span>
                    <span class="detail-value">{{ $appointment->message }}</span>
                </div>
                @endif
            </div>

            <!-- What Happens Next -->
            <div style="margin: 25px 0;">
                <h4 style="color: #3D493A; margin-bottom: 15px;">📞 What Happens Next?</h4>
                <ul style="color: #555; padding-left: 20px;">
                    <li style="margin-bottom: 8px;">Our team will review your appointment request</li>
                    <li style="margin-bottom: 8px;">We'll call you within 2 hours to confirm the appointment</li>
                    <li style="margin-bottom: 8px;">You'll receive a confirmation email once approved</li>
                    <li style="margin-bottom: 8px;">Please arrive 10 minutes early for your appointment</li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h4>📱 Need to Make Changes or Have Questions?</h4>
                <div class="contact-item">
                    <strong>Phone:</strong> +44 73 499 25427
                </div>
                <div class="contact-item">
                    <strong>Email:</strong> info@ceylonherbalhealth.co.uk
                </div>
                <div class="contact-item">
                    <strong>WhatsApp:</strong> +44 73 499 25427
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="cta-buttons">
                <a href="tel:+447349925427" class="cta-button">📞 Call Us</a>
                <a href="https://wa.me/447349925427?text=Hi! I have a question about my appointment on {{ $appointment->preferred_date->format('M j, Y') }}" class="cta-button whatsapp">💬 WhatsApp</a>
            </div>

            <p style="color: #6c757d; font-size: 14px; margin-top: 30px;">
                <strong>Note:</strong> This is an automated confirmation. Your appointment is not yet confirmed. We will contact you shortly to finalize the details.
            </p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p><strong>Ceylon Herbal Health</strong><br>
            Authentic Sri Lankan Ayurveda in the UK</p>
            
            <div class="footer-links">
                <a href="{{ route('home') }}">Website</a>
                <a href="{{ route('services.index') }}">Services</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
            
            <p style="margin-top: 15px; font-size: 12px;">
                © {{ date('Y') }} Ceylon Herbal Health. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>