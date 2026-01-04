<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductsServicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeaturedProjectsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\SitemapController;

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Landing page route
Route::get('/', [LandingPageController::class, 'index'])->name('home');

// Page routes
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/products-services', [ProductsServicesController::class, 'index'])->name('products-services');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product:slug}/quote', [ProductController::class, 'quoteRequest'])->name('products.quote-request');
Route::post('/products/{product:slug}/quote', [ProductController::class, 'storeQuoteRequest'])->name('products.quote-request.store');
Route::get('/products/{product:slug}/download-pdf', [ProductController::class, 'downloadPdf'])->name('products.download-pdf');

// Legacy route support
Route::get('/products-services/quote/{productId}', [ProductsServicesController::class, 'requestQuote'])->name('legacy.products.quote-request');
Route::get('/featured-projects', [FeaturedProjectsController::class, 'index'])->name('featured-projects');

// Project routes
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

// API route for featured projects
// Route::get('/api/featured-projects', [ProjectController::class, 'featured'])->name('api.featured-projects');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/awards-certificates', [AwardsController::class, 'index'])->name('awards');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Form submissions
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/quote-request', [QuoteRequestController::class, 'submit'])->name('quote.request.submit');

// Old welcome route (if needed)
Route::get('/welcome', function () {
    $posts = Post::orderBy('created_at', 'desc')->get(); 
    return view('welcome', compact('posts')); 
})->name('welcome');

// single post show 
Route::get('/post/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->firstOrFail();
    // Get 3 random blog posts
    $randomPosts = Post::inRandomOrder()
        ->limit(3)
        ->get();
    return view('pages.blog.sections.post-single', compact('post', 'randomPosts'));
})->name('post.show');

// Newsletter subscription
Route::post('/newsletter', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'email' => 'required|email',
    ]);
    
    // Handle newsletter subscription (save to database, add to mailing list, etc.)
    // For now, just redirect back with success message
    
    return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
})->name('newsletter.subscribe');

// Debug route to check post data
Route::get('/debug-post/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->firstOrFail();
    return response()->json([
        'featured_image' => $post->featured_image,
        'featured_image_url' => $post->featured_image_url,
        'storage_url' => $post->featured_image ? \Storage::url($post->featured_image) : null,
        'file_exists' => $post->featured_image ? \Storage::disk('public')->exists($post->featured_image) : false,
        'full_path' => $post->featured_image ? storage_path('app/public/' . $post->featured_image) : null,
    ]);
});

// Test route for projects system (remove in production)
if (app()->environment('local', 'development')) {
    require __DIR__ . '/test.php';
}
