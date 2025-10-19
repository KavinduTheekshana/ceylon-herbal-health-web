<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of all services.
     */
    public function index(): View
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->orderBy('title')
            ->get();

        return view('frontend.services.index', compact('services'));
    }

    /**
     * Display the specified service.
     */
    public function show(Service $service): View
    {
        // Ensure the service is active
        if (!$service->is_active) {
            abort(404);
        }

        // Get other services for the sidebar (exclude current)
        $otherServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->orderBy('title')
            ->limit(5)
            ->get();

        return view('frontend.services.show', compact('service', 'otherServices'));
    }

    /**
     * Check service availability (for AJAX calls)
     */
    public function checkAvailability(Service $service)
    {
        return response()->json([
            'available' => $service->is_active,
            'service' => [
                'id' => $service->id,
                'title' => $service->title,
                'slug' => $service->slug,
            ]
        ]);
    }

    /**
     * Get therapists for a specific service (for AJAX calls)
     */
    public function getTherapists($serviceId)
    {
        try {
            // Find the service
            $service = Service::findOrFail($serviceId);

            // Get active therapists assigned to this service
            $therapists = $service->therapists()
                ->where('therapists.is_active', true)
                ->orderBy('therapists.order')
                ->orderBy('therapists.name')
                ->select('therapists.id', 'therapists.name', 'therapists.specialization')
                ->get();

            return response()->json([
                'success' => true,
                'therapists' => $therapists
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading therapists: ' . $e->getMessage(),
                'therapists' => []
            ], 500);
        }
    }

    /**
     * Get therapist availability for calendar (for AJAX calls)
     */
    public function getTherapistAvailability($therapistId)
    {
        try {
            $therapist = \App\Models\Therapist::with(['availability', 'holidays'])->findOrFail($therapistId);

            // Get weekly schedule
            $weeklySchedule = $therapist->availability()
                ->where('is_available', true)
                ->get()
                ->groupBy('day_of_week')
                ->map(function ($schedules) {
                    return $schedules->map(function ($schedule) {
                        return [
                            'start_time' => $schedule->start_time->format('H:i'),
                            'end_time' => $schedule->end_time->format('H:i'),
                        ];
                    });
                });

            // Get holidays (unavailable dates)
            $holidays = $therapist->holidays()
                ->where('status', 'approved')
                ->where('end_date', '>=', now())
                ->get()
                ->map(function ($holiday) {
                    return [
                        'start_date' => $holiday->start_date->format('Y-m-d'),
                        'end_date' => $holiday->end_date->format('Y-m-d'),
                        'reason' => $holiday->reason,
                    ];
                });

            return response()->json([
                'success' => true,
                'therapist' => [
                    'id' => $therapist->id,
                    'name' => $therapist->name,
                ],
                'weekly_schedule' => $weeklySchedule,
                'holidays' => $holidays,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading availability: ' . $e->getMessage(),
            ], 500);
        }
    }
}