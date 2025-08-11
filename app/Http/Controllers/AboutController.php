<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Log;

class AboutController extends Controller
{
    /**
     * Display the about page.
     */
    public function index(): View
    {
        try {
            // Get featured services for the "What We Do" section
            $services = Service::where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->limit(4)
                ->get();

            // Get testimonials if you have them
            // Uncomment this when you have a Testimonial model
            // $testimonials = Testimonial::where('is_active', true)
            //     ->orderBy('created_at', 'desc')
            //     ->limit(6)
            //     ->get();

            // For now, you can pass empty collections or dummy data
            $testimonials = collect();

            Log::info('About page loaded', [
                'services_count' => $services->count()
            ]);
            
            return view('frontend.about.index', compact('services', 'testimonials'));
            
        } catch (\Exception $e) {
            Log::error('Error in AboutController: ' . $e->getMessage());
            
            // Fallback to empty collections
            $services = collect();
            $testimonials = collect();
            
            return view('frontend.about.index', compact('services', 'testimonials'));
        }
    }
}