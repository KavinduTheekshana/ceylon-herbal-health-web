<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You for Contacting Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3D493A;
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .message-details {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #ddd;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #96A650;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .footer {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Thank You for Contacting Us!</h1>
    </div>
    
    <div class="content">
        <p>Hello {{ $contact->name }},</p>
        
        <p>Thank you for reaching out to us. We have received your message and will get back to you within 24-48 hours.</p>
        
        <h2>Your Message Details</h2>
        <div class="message-details">
            <p><strong>Subject:</strong> {{ $contact->subject }}</p>
            <p><strong>Submitted:</strong> {{ $contact->created_at->format('M d, Y \a\t g:i A') }}</p>
            <p><strong>Your Message:</strong></p>
            <p>{{ $contact->message }}</p>
        </div>
        
        <p>In the meantime, feel free to:</p>
        
        <div class="button-container">
            <a href="{{ route('services.index') }}" class="button">Explore Our Services</a>
            <a href="{{ route('appointments.create') }}" class="button">Book an Appointment</a>
        </div>
        
        <p>If you have any urgent concerns, please don't hesitate to call us at <strong>+44 7349 925427</strong>.</p>
        
        <div class="footer">
            <p>Best regards,<br>
            {{ config('app.name') }} Team</p>
            
            <p><em>This is an automated confirmation email. Please do not reply to this email. If you need immediate assistance, please contact us directly.</em></p>
        </div>
    </div>
</body>
</html>