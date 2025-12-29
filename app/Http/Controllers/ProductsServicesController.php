<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsServicesController extends Controller
{
    public function index()
    {
        // Get all published products for the products-services page
        $products = Product::published()
            ->ordered()
            ->get();

        return view('pages.products-services.index', compact('products'));
    }

    public function requestQuote($productId)
    {
        // Legacy support for old URLs - redirect to new product system
        $product = Product::published()->where('id', $productId)->first();
        
        if ($product) {
            return redirect()->route('products.quote-request', $product);
        }
        
        // Fallback for non-existent products
        return redirect()->route('products.index')
            ->with('error', 'Product not found. Please browse our available products.');
    }
}
