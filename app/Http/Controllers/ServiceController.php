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
}