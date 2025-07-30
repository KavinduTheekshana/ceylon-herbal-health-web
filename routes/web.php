<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// =============================================================================
// HOME & MAIN PAGES
// =============================================================================

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Us
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Contact Us
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// =============================================================================
// SERVICES
// =============================================================================

// Services listing and individual service pages
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

// =============================================================================
// APPOINTMENTS SYSTEM
// =============================================================================

// Appointment booking system
Route::get('/book-appointment', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointment-success', [AppointmentController::class, 'success'])->name('appointments.success');

// Alternative appointment routes (for different entry points)
Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment');
Route::get('/booking', [AppointmentController::class, 'create'])->name('booking');

// =============================================================================
// BLOG SYSTEM
// =============================================================================

// Blog routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/{post:slug}', [BlogController::class, 'show'])->name('show');
});

// Alternative blog routes
Route::get('/articles', [BlogController::class, 'index'])->name('articles');
Route::get('/news', [BlogController::class, 'index'])->name('news');

// =============================================================================
// FAQ SYSTEM
// =============================================================================

// FAQ pages (you can create these controllers later)
Route::get('/faq', function () {
    return view('frontend.faq.index');
})->name('faq');

Route::get('/faqs', function () {
    return view('frontend.faq.index');
})->name('faqs');

// =============================================================================
// STATIC/CMS PAGES
// =============================================================================

// Privacy Policy, Terms, etc.
Route::get('/privacy-policy', [PageController::class, 'show'])->defaults('slug', 'privacy-policy')->name('privacy');
Route::get('/terms-conditions', [PageController::class, 'show'])->defaults('slug', 'terms-conditions')->name('terms');
Route::get('/refund-policy', [PageController::class, 'show'])->defaults('slug', 'refund-policy')->name('refund');

// =============================================================================
// TEAM & PRACTITIONERS
// =============================================================================

// Team pages (you can create these controllers later)
Route::get('/team', function () {
    return view('frontend.team.index');
})->name('team');

Route::get('/practitioners', function () {
    return view('frontend.team.index');
})->name('practitioners');

// Individual team member pages
Route::get('/team/{member:slug}', function () {
    return view('frontend.team.show');
})->name('team.show');

// =============================================================================
// GALLERY
// =============================================================================

// Image gallery (you can create controller later)
Route::get('/gallery', function () {
    return view('frontend.gallery.index');
})->name('gallery');

// Treatment photos
Route::get('/treatments-gallery', function () {
    return view('frontend.gallery.index', ['category' => 'treatments']);
})->name('gallery.treatments');

// =============================================================================
// TESTIMONIALS
// =============================================================================

// Testimonials page
Route::get('/testimonials', function () {
    return view('frontend.testimonials.index');
})->name('testimonials');

Route::get('/reviews', function () {
    return view('frontend.testimonials.index');
})->name('reviews');

// =============================================================================
// SPECIAL PAGES
// =============================================================================

// Newsletter subscription (AJAX route)
Route::post('/newsletter/subscribe', function () {
    // Handle newsletter subscription
    return response()->json(['success' => true]);
})->name('newsletter.subscribe');

// Search functionality
Route::get('/search', function () {
    return view('frontend.search.index');
})->name('search');

// Sitemap
Route::get('/sitemap.xml', function () {
    return response()->view('frontend.sitemap')->header('Content-Type', 'text/xml');
})->name('sitemap');

// =============================================================================
// REDIRECTS & LEGACY ROUTES
// =============================================================================

// Common misspellings or alternative URLs
Route::redirect('/book', '/book-appointment', 301);
Route::redirect('/appointment-booking', '/book-appointment', 301);
Route::redirect('/schedule', '/book-appointment', 301);
Route::redirect('/service', '/services', 301);
Route::redirect('/about-us', '/about', 301);
Route::redirect('/contact-us', '/contact', 301);

// =============================================================================
// API ROUTES (for AJAX calls)
// =============================================================================

// API routes for frontend functionality
Route::prefix('api')->name('api.')->group(function () {
    // Get available time slots for a specific date
    Route::get('/appointment-times/{date}', [AppointmentController::class, 'getAvailableTimes'])->name('appointment.times');
    
    // Check service availability
    Route::get('/service-availability/{service}', [ServiceController::class, 'checkAvailability'])->name('service.availability');
    
    // Quick contact form (for popups/modals)
    Route::post('/quick-contact', [ContactController::class, 'quickContact'])->name('contact.quick');
});

// =============================================================================
// CATCH-ALL ROUTE (Dynamic Pages)
// =============================================================================

// This should be the LAST route - catches any slug not matched above
// Useful for CMS pages created through admin panel
Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');

// =============================================================================
// FALLBACK ROUTE
// =============================================================================

// 404 fallback - uncomment if you want a custom 404 page
// Route::fallback(function () {
//     return view('frontend.errors.404');
// });

Route::get('/api/available-slots/{date}', [AppointmentController::class, 'getAvailableSlots'])
    ->name('api.available-slots');