<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Appointment Request - Ceylon Herbal Health</title>
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
            background: linear-gradient(135deg, #dc3545, #fd7e14);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .email-body {
            padding: 40px 30px;
        }
        
        .urgent-notice {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .appointment-card {
            border: 2px solid #3D493A;
            border-radius: 10px;
            padding: 25px;
            margin: 20px 0;
            background-color: #f8f9fa;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 20px 0;
        }
        
        .detail-item {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            border-left: 3px solid #3D493A;
        }
        
        .detail-label {
            font-size: 12px;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .detail-value {
            font-size: 16px;
            color: #333;
            font-weight: bold;
        }
        
        .patient-message {
            background-color: #e8f5e8;
            border-left: 4px solid #3D493A;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .action-buttons {
            text-align: center;
            margin: 30px 0;
        }
        
        .action-button {
            display: inline-block;
            padding: 12px 25px;
            margin: 10px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            color: white;
            transition: all 0.3s ease;
        }
        
        .confirm-btn {
            background-color: #28a745;
        }
        
        .call-btn {
            background-color: #007bff;
        }
        
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        
        @media (max-width: 600px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
            
            .email-body {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>🚨 New Appointment Request</h1>
            <p>Action Required</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="urgent-notice">
                <strong>⏰ URGENT:</strong> Please contact the patient within 2 hours to confirm this appointment.
            </div>

            <h2 style="color: #3D493A; margin-bottom: 20px;">New appointment request received</h2>
            
            <div class="appointment-card">
                <h3 style="color: #3D493A; margin-bottom: 20px; text-align: center;">👤 Patient Information</h3>
                
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Patient Name</div>
                        <div class="detail-value">{{ $appointment->name }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $appointment->email }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Phone</div>
                        <div class="detail-value">{{ $appointment->phone }}</div>
                    </div>
                    
                    @if($appointment->age)
                    <div class="detail-item">
                        <div class="detail-label">Age</div>
                        <div class="detail-value">{{ $appointment->age }} years</div>
                    </div>
                    @endif
                </div>

                <h3 style="color: #3D493A; margin: 30px 0 20px; text-align: center;">📅 Appointment Details</h3>
                
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Service Requested</div>
                        <div class="detail-value">{{ $service->title ?? 'Service' }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Preferred Date</div>
                        <div class="detail-value">{{ $appointment->preferred_date->format('l, F j, Y') }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Preferred Time</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($appointment->preferred_time)->format('g:i A') }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Practitioner</div>
                        <div class="detail-value">{{ $appointment->practitioner_name }}</div>
                    </div>
                </div>

                @if($appointment->message)
                <div class="patient-message">
                    <div class="detail-label">Patient Message/Health Concerns:</div>
                    <p style="margin-top: 10px; font-style: italic;">{{ $appointment->message }}</p>
                </div>
                @endif

                <div style="margin-top: 20px; padding: 15px; background-color: #fff3cd; border-radius: 5px;">
                    <strong>📋 Booking ID:</strong> #{{ $appointment->id }}<br>
                    <strong>📅 Submitted:</strong> {{ $appointment->created_at->format('M j, Y \a\t g:i A') }}
                </div>
            </div>

            <!-- Action Required -->
            <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; padding: 20px; margin: 25px 0;">
                <h4 style="color: #721c24; margin-bottom: 15px;">⚡ Action Required:</h4>
                <ol style="color: #721c24; padding-left: 20px;">
                    <li style="margin-bottom: 8px;">Call the patient at <strong>{{ $appointment->phone }}</strong></li>
                    <li style="margin-bottom: 8px;">Confirm the appointment date and time</li>
                    <li style="margin-bottom: 8px;">Update the appointment status in the admin panel</li>
                    <li style="margin-bottom: 8px;">Send confirmation email to patient</li>
                </ol>
            </div>

            <!-- Quick Actions -->
            <div class="action-buttons">
                <a href="tel:{{ $appointment->phone }}" class="action-button call-btn">📞 Call Patient</a>
                <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $appointment->phone) }}?text=Hello {{ $appointment->name }}, this is Ceylon Herbal Health. We received your appointment request for {{ $appointment->preferred_date->format('M j, Y') }} at {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('g:i A') }}. We would like to confirm your appointment." class="action-button confirm-btn">💬 WhatsApp</a>
            </div>

            <p style="color: #6c757d; font-size: 14px; text-align: center; margin-top: 30px;">
                <strong>Response Time Target:</strong> Contact patient within 2 hours of this request.
            </p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p><strong>Ceylon Herbal Health - Admin Panel</strong></p>
            <p style="margin-top: 10px; font-size: 12px;">
                This notification was sent at {{ now()->format('M j, Y \a\t g:i A') }}
            </p>
        </div>
    </div>
</body>
</html>