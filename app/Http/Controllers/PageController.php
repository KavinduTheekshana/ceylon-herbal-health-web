<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        // For now, just return a 404 or basic view
        abort(404);
    }
}
