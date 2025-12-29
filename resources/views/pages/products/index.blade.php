<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - Casa Generators</title>
    <meta name="description" content="Explore our comprehensive range of generator solutions, from high-power industrial units to commercial and residential generators.">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    
    
  
<section class="products-listing">
    <div class="container">
        @if($products->isEmpty())
            <div class="text-center py-5">
                <h3>No products available at the moment</h3>
                <p class="text-muted">Please check back later for our latest product offerings.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us for Information</a>
            </div>
        @else
            <div class="products-grid">
                @foreach($products as $product)
                <article class="product-card">
                    <div class="product-image">
                        @if($product->featured_image)
                            <img src="{{ $product->featured_image_url }}" 
                                 alt="{{ $product->image_alt_text ?: $product->title }}" 
                                 loading="lazy">
                        @else
                            <div class="placeholder-image">
                                <i class="fas fa-cog"></i>
                            </div>
                        @endif
                        
                        @if($product->is_featured)
                            <span class="featured-badge">Featured</span>
                        @endif
                        
                        @if($product->category)
                            <span class="category-badge">{{ $product->category }}</span>
                        @endif
                    </div>
                    
                    <div class="product-content">
                        <h3 class="product-title">
                            <a href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
                        </h3>
                        
                        @if($product->short_description)
                            <p class="product-description">{{ $product->short_description }}</p>
                        @endif
                        
                        <div class="product-meta">
                            @if($product->power_range)
                                <span class="power-range">
                                    <i class="fas fa-bolt"></i> {{ $product->power_range }}
                                </span>
                            @endif
                            
                            @if($product->price)
                                <span class="price">{{ $product->formatted_price }}</span>
                            @endif
                        </div>
                        
                        <div class="product-actions">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">
                                View Details
                            </a>
                            <a href="{{ route('products.quote-request', $product) }}" class="btn btn-primary">
                                Request Quote
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

 
    
    <style>
<style>
.hero-banner {
    background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
    color: white;
    padding: 4rem 0;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.breadcrumb {
    
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    margin: 0;
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: white;
}

.products-listing {
    padding: 4rem 0;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.product-card {
    background: white;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.product-image {
    position: relative;
    height: 250px;
    overflow: hidden;
    border-radius: 1rem 1rem 0 0;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 1rem 1rem 0 0;
}

.placeholder-image {
    width: 100%;
    height: 100%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    font-size: 3rem;
}

.featured-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: #dc2626;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.category-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.75rem;
    font-weight: 500;
}

.product-content {
    padding: 1.5rem;
}

.product-title {
    margin: 0 0 1rem 0;
    font-size: 1.25rem;
    font-weight: 600;
    line-height: 1.4;
}

.product-title a {
    color: #111827;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-title a:hover {
    color: #3b82f6;
}

.product-description {
    color: #6b7280;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.product-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.power-range {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #059669;
    font-weight: 500;
    font-size: 0.875rem;
}

.price {
    font-size: 1.125rem;
    font-weight: 600;
    color: #dc2626;
}

.product-actions {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    text-decoration: none;
    text-align: center;
    transition: all 0.3s ease;
    display: inline-block;
    border: 1px solid transparent;
}

.btn-primary {
    background: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background: #2563eb;
    color: white;
}

.btn-outline-primary {
    color: #3b82f6;
    border-color: #3b82f6;
    background: transparent;
}

.btn-outline-primary:hover {
    background: #3b82f6;
    color: white;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
    }
    
    .product-actions {
        flex-direction: column;
    }
}
</style>


</body>
</html>