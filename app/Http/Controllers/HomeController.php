<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()
            ->featured() // You can use featured or not depending on your needs
            ->orderBy('order')
            ->limit(4) // Limit to 4 items for the homepage section
            ->get();
        return view('frontend.home.index', compact('services'));
    }
}
