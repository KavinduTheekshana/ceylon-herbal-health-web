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
}