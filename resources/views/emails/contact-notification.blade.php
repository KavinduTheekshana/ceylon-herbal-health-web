<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
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
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .detail-row {
            margin: 10px 0;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .message-box {
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
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Form Submission</h1>
    </div>
    
    <div class="content">
        <p>You have received a new message through the contact form on your website.</p>
        
        <h2>Contact Details</h2>
        
        <div class="detail-row">
            <span class="label">Name:</span> {{ $contact->name }}
        </div>
        
        <div class="detail-row">
            <span class="label">Email:</span> 
            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
        </div>
        
        @if($contact->phone)
        <div class="detail-row">
            <span class="label">Phone:</span> {{ $contact->phone }}
        </div>
        @endif
        
        <div class="detail-row">
            <span class="label">Subject:</span> {{ $contact->subject }}
        </div>
        
        <div class="detail-row">
            <span class="label">Submitted:</span> {{ $contact->created_at->format('M d, Y \a\t g:i A') }}
        </div>
        
        <h2>Message</h2>
        <div class="message-box">
            {{ $contact->message }}
        </div>
        
        <hr>
        
        <p style="color: #666; font-size: 14px;">
            You can reply to this message directly by responding to {{ $contact->email }}.
        </p>
    </div>
</body>
</html>