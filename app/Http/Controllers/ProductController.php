<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of published products.
     */
    public function index(Request $request): View
    {
        $query = Product::published()->orderBy('created_at', 'desc');

        // Filter by Fuel
        if ($request->has('fuel')) {
            $fuel = $request->fuel;
            if (is_array($fuel)) {
                $query->whereIn('fuel', $fuel);
            } else {
                $query->where('fuel', $fuel);
            }
        }

        // Filter by Frequency (check both direct field and JSON)
        if ($request->has('frequency')) {
             $frequency = $request->frequency;
             if (is_array($frequency)) {
                 $query->where(function($q) use ($frequency) {
                     $q->whereIn('frequency', $frequency)
                       ->orWhere(function($subQ) use ($frequency) {
                           foreach ($frequency as $freq) {
                               $subQ->orWhereJsonContains('technical_specifications->general->frequency', $freq);
                           }
                       });
                 });
             } else {
                 $query->where(function($q) use ($frequency) {
                     $q->where('frequency', $frequency)
                       ->orWhereJsonContains('technical_specifications->general->frequency', $frequency);
                 });
             }
        }

        // Filter by Voltage
        if ($request->has('voltage')) {
             $voltage = $request->voltage;
             if (is_array($voltage)) {
                 $query->whereIn('voltage', $voltage);
             } else {
                 $query->where('voltage', $voltage);
             }
        }

        // Filter by Emissions (check both direct field and JSON)
        if ($request->has('emissions')) {
             $emissions = $request->emissions;
             if (is_array($emissions)) {
                 $query->where(function($q) use ($emissions) {
                     $q->whereIn('emissions_rating', $emissions)
                       ->orWhere(function($subQ) use ($emissions) {
                           foreach ($emissions as $emission) {
                               $subQ->orWhereJsonContains('technical_specifications->general->emissions_level', $emission);
                           }
                       });
                 });
             } else {
                 $query->where(function($q) use ($emissions) {
                     $q->where('emissions_rating', $emissions)
                       ->orWhereJsonContains('technical_specifications->general->emissions_level', $emissions);
                 });
             }
        }

        // Filter by Version
        if ($request->has('version')) {
             $version = $request->version;
             if (is_array($version)) {
                 $query->whereIn('version', $version);
             } else {
                 $query->where('version', $version);
             }
        }

        // Filter by Engine
        if ($request->has('engine')) {
             $engine = $request->engine;
             if (is_array($engine)) {
                 $query->whereIn('engine_brand', $engine);
             } else {
                 $query->where('engine_brand', $engine);
             }
        }

        $products = $query->paginate(9)->withQueryString();

        // Get filter options (distinct values) to pass to view
        $fuels = Product::published()->distinct()->whereNotNull('fuel')->pluck('fuel')->filter()->unique()->sort()->values();
        
        // For frequency, check both direct field and technical_specifications
        $frequencies = collect();
        $directFrequencies = Product::published()->whereNotNull('frequency')->pluck('frequency');
        $frequencies = $frequencies->merge($directFrequencies);
        
        // Also get from technical_specifications->general->frequency
        $allProducts = Product::published()->whereNotNull('technical_specifications')->get();
        foreach ($allProducts as $product) {
            if (isset($product->technical_specifications['general']['frequency'])) {
                $frequencies->push($product->technical_specifications['general']['frequency']);
            }
        }
        $frequencies = $frequencies->filter()->unique()->sort()->values();
        
        $voltages = Product::published()->distinct()->whereNotNull('voltage')->pluck('voltage')->filter()->unique()->sort()->values();
        
        // For emissions, check both emissions_rating and technical_specifications
        $emissions = collect();
        $directEmissions = Product::published()->whereNotNull('emissions_rating')->pluck('emissions_rating');
        $emissions = $emissions->merge($directEmissions);
        
        // Also get from technical_specifications->general->emissions_level
        foreach ($allProducts as $product) {
            if (isset($product->technical_specifications['general']['emissions_level'])) {
                $emissions->push($product->technical_specifications['general']['emissions_level']);
            }
        }
        $emissions = $emissions->filter()->unique()->sort()->values();
        
        $versions = Product::published()->distinct()->whereNotNull('version')->pluck('version')->filter()->unique()->sort()->values();
        $engines = Product::published()->distinct()->whereNotNull('engine_brand')->pluck('engine_brand')->filter()->unique()->sort()->values();

        return view('pages.products.index', compact(
            'products', 
            'fuels', 
            'frequencies', 
            'voltages', 
            'emissions', 
            'versions', 
            'engines'
        ));
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): View
    {
        // Ensure the product is published (unless in admin)
        if ($product->status !== 'published') {
            abort(404);
        }

        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the quote request form for a specific product.
     */
    public function quoteRequest(Product $product): View
    {
        // Ensure the product is published
        if ($product->status !== 'published') {
            abort(404);
        }

        return view('pages.products.quote-request', compact('product'));
    }

    /**
     * Store a quote request for a specific product.
     */
    public function storeQuoteRequest(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'industry' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:2000',
        ]);

        $validated['product_id'] = $product->id;
        $validated['product_name'] = $product->title;

        QuoteRequest::create($validated);

        return redirect()
            ->route('products.quote-request', $product)
            ->with('success', 'Your quote request has been submitted successfully!');
    }

    /**
     * Download product details as PDF.
     */
    public function downloadPdf(Product $product)
    {
        // Ensure the product is published
        if ($product->status !== 'published') {
            abort(404);
        }

        // If product has an uploaded PDF file, download it
        if ($product->hasPdfFile()) {
            return $this->downloadUploadedPdf($product);
        }

        // If no PDF is uploaded, return 404 (the frontend should handle the UI state)
        abort(404, 'PDF file not found.');
    }

    /**
     * Download the uploaded PDF file for a product.
     */
    public function downloadUploadedPdf(Product $product)
    {
        // Ensure the product is published
        if ($product->status !== 'published') {
            abort(404);
        }

        // Check if product has a PDF file
        if (!$product->hasPdfFile()) {
            abort(404, 'PDF file not found.');
        }

        $filePath = storage_path('app/public/' . $product->pdf_file);
        
        // Check if file actually exists on disk
        if (!file_exists($filePath)) {
            abort(404, 'PDF file not found on disk.');
        }

        $fileName = $product->pdf_title ?: pathinfo($product->pdf_file, PATHINFO_BASENAME);
        
        return response()->download($filePath, $fileName);
    }

    /**
     * Get products for API or AJAX requests.
     */
    public function api()
    {
        return Product::published()
            ->orderBy('created_at', 'desc')
            ->select(['id', 'title', 'slug', 'short_description', 'category', 'featured_image', 'price'])
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'short_description' => $product->short_description,
                    'category' => $product->category,
                    'featured_image_url' => $product->featured_image_url,
                    'formatted_price' => $product->formatted_price,
                ];
            });
    }
}