<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * Display the FAQ page with all categories and questions.
     */
    public function index(): View
    {
        // Get all active categories with their active FAQs
        $categories = FaqCategory::with(['faqs' => function ($query) {
            $query->where('is_active', true)
                  ->orderBy('order')
                  ->orderBy('id');
        }])
        ->orderBy('order')
        ->orderBy('id')
        ->get();

        // Filter out categories with no active FAQs
        $categories = $categories->filter(function ($category) {
            return $category->faqs->count() > 0;
        });

        return view('frontend.faq.index', compact('categories'));
    }
}