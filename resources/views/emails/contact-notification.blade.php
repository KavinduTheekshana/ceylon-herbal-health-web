{{-- resources/views/emails/contact-notification.blade.php --}}
@component('mail::message')
# New Contact Form Submission

You have received a new message through the contact form on your website.

## Contact Details
**Name:** {{ $contact->name }}  
**Email:** {{ $contact->email }}  
@if($contact->phone)
**Phone:** {{ $contact->phone }}  
@endif
**Subject:** {{ $contact->subject }}  
**Submitted:** {{ $contact->created_at->format('M d, Y \a\t g:i A') }}

## Message
{{ $contact->message }}

---

@component('mail::button', ['url' => config('app.url') . '/admin/contacts/' . $contact->id])
View in Admin Panel
@endcomponent

You can reply to this message directly by responding to {{ $contact->email }}.

Thanks,<br>
{{ config('app.name') }} Website
@endcomponent