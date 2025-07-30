<?php
// File: app/Http/Controllers/HomeController.php (Updated to include services for appointment form)

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured services for the services section
        $services = Service::active()
            ->featured() // You can use featured or not depending on your needs
            ->orderBy('order')
            ->limit(4) // Limit to 4 items for the homepage section
            ->get();

        // Get all active services for appointment booking form
        $allServices = Service::active()
            ->orderBy('order')
            ->orderBy('title')
            ->get();
        
        return view('frontend.home.index', compact('services', 'allServices'));
    }
}