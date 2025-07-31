{{-- resources/views/emails/contact-confirmation.blade.php --}}
@component('mail::message')
# Thank You for Contacting Us!

Hello {{ $contact->name }},

Thank you for reaching out to us. We have received your message and will get back to you within 24-48 hours.

## Your Message Details
**Subject:** {{ $contact->subject }}  
**Submitted:** {{ $contact->created_at->format('M d, Y \a\t g:i A') }}

**Your Message:**
{{ $contact->message }}

---

In the meantime, feel free to:

@component('mail::button', ['url' => route('services.index')])
Explore Our Services
@endcomponent

@component('mail::button', ['url' => route('appointments.create')])
Book an Appointment
@endcomponent

If you have any urgent concerns, please don't hesitate to call us at **+44 7349 925427**.

Best regards,<br>
{{ config('app.name') }} Team

---

*This is an automated confirmation email. Please do not reply to this email. If you need immediate assistance, please contact us directly.*
@endcomponent