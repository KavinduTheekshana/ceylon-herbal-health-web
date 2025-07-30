<?php
// File: app/Http/Controllers/AppointmentController.php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display the appointment booking form
     */
    public function create()
    {
        $services = Service::active()
            ->orderBy('order')
            ->orderBy('title')
            ->get();

        return view('frontend.appointments.create', compact('services'));
    }

    /**
     * Store a new appointment request
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required|string',
            'practitioner_id' => 'nullable|integer',
            'age' => 'nullable|integer|min:1|max:120',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please check the form for errors and try again.');
        }

        try {
            // Create the appointment
            $appointment = Appointment::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'service_id' => $request->service_id,
                'preferred_date' => $request->preferred_date,
                'preferred_time' => $request->preferred_time,
                'message' => $request->message,
                'status' => 'pending',
            ]);

            // Send confirmation email to patient
            $this->sendPatientConfirmation($appointment);

            // Send notification email to admin
            $this->sendAdminNotification($appointment);

            // Redirect with success message
            return redirect()->route('appointments.success')
                ->with('success', 'Your appointment request has been submitted successfully! We will contact you within 2 hours to confirm.');

        } catch (\Exception $e) {
            \Log::error('Appointment booking error: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'There was an error processing your appointment. Please try again or call us directly.');
        }
    }

    /**
     * Show appointment success page
     */
    public function success()
    {
        return view('frontend.appointments.success');
    }

    /**
     * Send confirmation email to patient
     */
    private function sendPatientConfirmation($appointment)
    {
        try {
            $service = Service::find($appointment->service_id);
            
            $data = [
                'appointment' => $appointment,
                'service' => $service,
                'subject' => 'Appointment Request Confirmation - Ceylon Herbal Health'
            ];

            Mail::send('emails.appointment-confirmation', $data, function($message) use ($appointment, $data) {
                $message->to($appointment->email, $appointment->name)
                       ->subject($data['subject']);
            });

        } catch (\Exception $e) {
            \Log::error('Failed to send patient confirmation email: ' . $e->getMessage());
        }
    }

    /**
     * Send notification email to admin
     */
    private function sendAdminNotification($appointment)
    {
        try {
            $service = Service::find($appointment->service_id);
            
            $data = [
                'appointment' => $appointment,
                'service' => $service,
                'subject' => 'New Appointment Request - Ceylon Herbal Health'
            ];

            $adminEmail = config('mail.admin_email', 'admin@ceylonherbalhealth.co.uk');

            Mail::send('emails.appointment-notification', $data, function($message) use ($adminEmail, $data) {
                $message->to($adminEmail)
                       ->subject($data['subject']);
            });

        } catch (\Exception $e) {
            \Log::error('Failed to send admin notification email: ' . $e->getMessage());
        }
    }
}