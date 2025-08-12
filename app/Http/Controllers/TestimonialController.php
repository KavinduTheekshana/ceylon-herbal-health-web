<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display all testimonials.
     */
    public function index(): View
    {
        $testimonials = Testimonial::with('service')
            ->active()
            ->ordered()
            ->get();

        return view('frontend.testimonials.index', compact('testimonials'));
    }
}