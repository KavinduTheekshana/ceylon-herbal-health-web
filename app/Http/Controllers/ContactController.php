<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index(): View
    {
        return view('frontend.contact.index');
    }

    /**
     * Store a newly created contact message.
     */
    public function store(ContactFormRequest $request): RedirectResponse
    {
        // Rate limiting to prevent spam
        $key = 'contact-form:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->back()
                ->withInput()
                ->with('error', "Too many contact attempts. Please try again in {$seconds} seconds.");
        }

        RateLimiter::hit($key, 300); // 5 minutes decay

        try {
            // Combine first and last name
            $fullName = trim($request->fname . ' ' . $request->lname);

            // Create the contact record
            $contact = Contact::create([
                'name' => $fullName,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => 'General Inquiry via Contact Form',
                'message' => $request->message,
                'status' => Contact::STATUS_NEW,
            ]);

            // Send notification email to admin
            $this->sendNotificationToAdmin($contact);

            // Send confirmation email to user
            $this->sendConfirmationToUser($contact);

            // Clear rate limit on successful submission
            RateLimiter::clear($key);

            return redirect()->back()->with('success', 'Thank you for contacting us! We have received your message and will get back to you within 24-48 hours.');

        } catch (\Exception $e) {
            Log::error('Contact form submission failed: ' . $e->getMessage(), [
                'email' => $request->email,
                'name' => $request->fname . ' ' . $request->lname,
                'ip' => $request->ip(),
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'We apologize, but something went wrong while sending your message. Please try again or contact us directly at +44 7349 925427.');
        }
    }

    /**
     * Handle quick contact form submissions (for AJAX calls).
     */
    public function quickContact(Request $request)
    {
        // Rate limiting
        $key = 'quick-contact:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json([
                'success' => false,
                'message' => 'Too many attempts. Please try again later.'
            ], 429);
        }

        RateLimiter::hit($key, 300);

        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        try {
            // Create the contact record
            $contact = Contact::create([
                'name' => $request->name,
                'email' => strtolower(trim($request->email)),
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => Contact::STATUS_NEW,
            ]);

            // Send notifications
            $this->sendNotificationToAdmin($contact);
            $this->sendConfirmationToUser($contact);

            RateLimiter::clear($key);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us! We will get back to you soon.'
            ]);

        } catch (\Exception $e) {
            Log::error('Quick contact form submission failed: ' . $e->getMessage(), [
                'email' => $request->email,
                'name' => $request->name,
                'ip' => $request->ip(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    /**
     * Send notification email to admin about new contact.
     */
    private function sendNotificationToAdmin(Contact $contact): void
    {
        try {
            // Check if admin email is configured
            $adminEmail = config('mail.admin_email', 'admin@ayurveda-wellness.com');
            
            if (!$adminEmail) {
                Log::warning('Admin email not configured for contact notifications');
                return;
            }

            Mail::send('emails.contact-notification', ['contact' => $contact], function ($message) use ($contact, $adminEmail) {
                $message->to($adminEmail)
                        ->subject('New Contact: ' . $contact->subject)
                        ->replyTo($contact->email, $contact->name);
            });
            
            Log::info('Admin notification sent for contact', [
                'contact_id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Failed to send admin notification: ' . $e->getMessage(), [
                'contact_id' => $contact->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Send confirmation email to user.
     */
    private function sendConfirmationToUser(Contact $contact): void
    {
        try {
            Mail::send('emails.contact-confirmation', ['contact' => $contact], function ($message) use ($contact) {
                $message->to($contact->email, $contact->name)
                        ->subject('Thank you for contacting us - We\'ll be in touch soon!');
            });
            
            Log::info('Confirmation email sent to user', [
                'contact_id' => $contact->id,
                'email' => $contact->email,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Failed to send user confirmation: ' . $e->getMessage(), [
                'contact_id' => $contact->id,
                'email' => $contact->email,
                'error' => $e->getMessage(),
            ]);
        }
    }
}