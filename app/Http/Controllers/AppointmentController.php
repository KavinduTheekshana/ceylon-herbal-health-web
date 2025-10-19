<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    /**
     * Display the appointment booking form
     */
    public function create()
    {
        $allServices = Service::where('is_active', true)
            ->orderBy('order')
            ->orderBy('title')
            ->get();

        return view('frontend.appointments.create', compact('allServices'));
    }

    /**
     * Store a new appointment request
     */
    public function store(Request $request)
    {
        Log::info('Appointment form submitted', [
            'data' => $request->all(),
            'url' => $request->url(),
            'method' => $request->method()
        ]);

        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'therapist_id' => 'required|exists:therapists,id',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required|string',
            'age' => 'nullable|integer|min:1|max:120',
            'message' => 'nullable|string|max:1000',
        ], [
            'preferred_date.after' => 'Please select a date from tomorrow onwards.',
            'service_id.required' => 'Please select a service.',
            'service_id.exists' => 'The selected service is not available.',
            'therapist_id.required' => 'Please select a therapist.',
            'therapist_id.exists' => 'The selected therapist is not available.',
        ]);

        if ($validator->fails()) {
            Log::warning('Appointment validation failed', [
                'errors' => $validator->errors()->toArray(),
                'input' => $request->all()
            ]);

            // Return JSON for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check the form for errors and try again.',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please check the form for errors and try again.');
        }

        try {
            // Check for duplicate appointments (same email, date, time)
            $existingAppointment = Appointment::where('email', $request->email)
                ->where('preferred_date', $request->preferred_date)
                ->where('preferred_time', $request->preferred_time)
                ->whereIn('status', ['pending', 'confirmed'])
                ->first();

            if ($existingAppointment) {
                Log::info('Duplicate appointment attempt', [
                    'email' => $request->email,
                    'date' => $request->preferred_date,
                    'time' => $request->preferred_time
                ]);

                // Return JSON for AJAX requests
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You already have an appointment request for this date and time. Please choose a different time or contact us directly.'
                    ], 422);
                }

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'You already have an appointment request for this date and time. Please choose a different time or contact us directly.');
            }

            // Create the appointment
            $appointment = Appointment::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
                'service_id' => $request->service_id,
                'therapist_id' => $request->therapist_id,
                'preferred_date' => $request->preferred_date,
                'preferred_time' => $request->preferred_time,
                'message' => $request->message,
                'status' => 'pending',
            ]);

            Log::info('Appointment created successfully', [
                'appointment_id' => $appointment->id,
                'email' => $appointment->email
            ]);

            // Send confirmation email to patient
            $this->sendPatientConfirmation($appointment);

            // Send notification email to admin
            $this->sendAdminNotification($appointment);

            // Load relationships for response
            $appointment->load(['service', 'therapist']);

            // Return JSON for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your appointment request has been submitted successfully!',
                    'appointment' => [
                        'id' => $appointment->id,
                        'name' => $appointment->name,
                        'service_name' => $appointment->service->title ?? 'N/A',
                        'therapist_name' => $appointment->therapist->name ?? 'N/A',
                        'preferred_date' => $appointment->preferred_date,
                        'preferred_time' => $appointment->preferred_time,
                        'status' => $appointment->status,
                    ]
                ]);
            }

            // Redirect with success message
            return redirect()->route('appointments.success')
                ->with([
                    'success' => 'Your appointment request has been submitted successfully!',
                    'appointment' => $appointment
                ]);

        } catch (\Exception $e) {
            Log::error('Appointment booking error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            // Return JSON for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'There was an error processing your appointment. Please try again or call us directly at +44 73 499 25427.'
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'There was an error processing your appointment. Please try again or call us directly at +44 73 499 25427.');
        }
    }

    /**
     * Show appointment success page
     */
    public function success()
    {
        $appointment = session('appointment');
        return view('frontend.appointments.success', compact('appointment'));
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
                       ->subject($data['subject'])
                       ->from(config('mail.from.address'), config('mail.from.name'));
            });

            Log::info('Patient confirmation email sent successfully', [
                'appointment_id' => $appointment->id,
                'email' => $appointment->email
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send patient confirmation email', [
                'appointment_id' => $appointment->id,
                'email' => $appointment->email,
                'error' => $e->getMessage()
            ]);
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
                       ->subject($data['subject'])
                       ->from(config('mail.from.address'), config('mail.from.name'));
            });

            Log::info('Admin notification email sent successfully', [
                'appointment_id' => $appointment->id,
                'admin_email' => $adminEmail
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send admin notification email', [
                'appointment_id' => $appointment->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Get booked time slots for a specific therapist and date
     */
    public function getBookedSlots(Request $request, $therapistId, $date)
    {
        try {
            // Validate the date format
            $validator = Validator::make(['date' => $date], [
                'date' => 'required|date|date_format:Y-m-d'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid date format'
                ], 422);
            }

            // Get all booked appointments for this therapist and date
            // Only consider pending and confirmed appointments
            $bookedAppointments = Appointment::where('therapist_id', $therapistId)
                ->where('preferred_date', $date)
                ->whereIn('status', ['pending', 'confirmed'])
                ->pluck('preferred_time')
                ->toArray();

            return response()->json([
                'success' => true,
                'booked_slots' => $bookedAppointments,
                'date' => $date,
                'therapist_id' => $therapistId
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching booked slots', [
                'therapist_id' => $therapistId,
                'date' => $date,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error loading booked time slots'
            ], 500);
        }
    }
}