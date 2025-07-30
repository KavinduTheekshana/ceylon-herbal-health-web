<?php
// File: app/Http/Controllers/HomeController.php (Updated to include services for appointment form)
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Get featured services for the services section
            $services = Service::where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->limit(4)
                ->get();

            // Get all active services for appointment booking form
            $allServices = Service::where('is_active', true)
                ->orderBy('order')
                ->orderBy('title')
                ->get();

            // If no services exist, create some default ones or handle gracefully
            if ($allServices->isEmpty()) {
                Log::warning('No active services found for appointment booking');
                // You can either create default services or handle the empty case
                $allServices = collect(); // Empty collection
            }

            Log::info('Home page loaded', [
                'services_count' => $services->count(),
                'all_services_count' => $allServices->count()
            ]);
            
            return view('frontend.home.index', compact('services', 'allServices'));
        } catch (\Exception $e) {
            Log::error('Error in HomeController: ' . $e->getMessage());
            
            // Fallback to empty collections
            $services = collect();
            $allServices = collect();
            
            return view('frontend.home.index', compact('services', 'allServices'));
        }
    }
}
