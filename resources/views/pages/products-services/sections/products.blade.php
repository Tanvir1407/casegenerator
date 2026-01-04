@php
    function getProductSpec($product, $search) {
        if (!$product || !$product->specifications) return null;
        foreach ($product->specifications as $spec) {
            if (isset($spec['spec_name']) && stripos($spec['spec_name'], $search) !== false) {
                return $spec['spec_value'];
            }
        }
        return null;
    }
@endphp

<section class="products-showcase">
    <div class="container">
        <h2 class="section-title text-center">Providing Innovative & Sustainable Solutions</h2>
        <p class="section-subtitle text-center">Building The Future, Restoring The Past</p>
        
        @if($products->isEmpty())
            <div class="text-center py-5">
                <h3>No products available at the moment</h3>
                <p class="text-muted">Please check back later for our latest product offerings.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us for Information</a>
            </div>
        @else
            <div class="premium-grid">
                @foreach($products as $index => $product)
                <div class="comparison-card">
                    <div class="card-visual {{ $index % 2 != 0 ? 'teal-theme' : '' }}">
                        <div class="visual-header">
                            @if($product->category)
                            <div class="card-tag">{{ $product->category }}</div>
                            @endif
                            
                        </div>
                        <div class="product-render">
                            @if($product->featured_image)
                                <img src="{{ $product->featured_image_url }}" alt="{{ $product->title }}"
                                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 400 300%27%3E%3Crect fill=%27%23f3f4f6%27 width=%27400%27 height=%27300%27/%3E%3Cg fill=%27%239ca3af%27%3E%3Cpath d=%27M150 90h100v50H150z%27 opacity=%270.3%27/%3E%3Ccircle cx=%27200%27 cy=%27150%27 r=%2730%27/%3E%3Cpath d=%27M185 150l10 10 20-20%27 stroke=%27%23f3f4f6%27 stroke-width=%273%27 fill=%27none%27/%3E%3C/g%3E%3Ctext x=%27200%27 y=%27230%27 text-anchor=%27middle%27 font-family=%27Arial%27 font-size=%2714%27 fill=%27%239ca3af%27%3EProduct Image%3C/text%3E%3C/svg%3E';">
                            @else
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image"></i>
                                    <span>No Image Found</span>
                                </div>
                            @endif
                        </div>
                        <div class="visual-footer">
                            <div class="feature-badges">
                                @if($product->power_range)
                                    <span>{{ $product->power_range }}</span>
                                @else
                                    <span>50Hz</span>
                                    <span>3 PHASES</span>
                                @endif
                            </div>
                            {{-- <div class="brand-brand">
                                <i class="fas fa-circle"></i> DAGARTECH
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-details">
                        <div class="spec-grid">
                            {{-- Power Spec --}}
                            <div class="spec-group">
                                <h2 class="product-model-overlay">{{ $product->title }}</h2>
                                
                                
                            </div>
                            
                            <div class="power-voltage">
                                {{-- Power Spec --}}
                                @if($product->power_range)
                                <div class="spec-item">
                                    <div class="spec-icon-box"><i class="fas fa-bolt"></i></div>
                                    <div class="spec-content">
                                        <label class="spec-label">POWER RANGE</label>
                                        <p class="spec-value">{{ $product->power_range }}</p>
                                    </div>
                                </div>
                                @endif

                                {{-- Voltage Spec --}}
                                <div class="spec-item">
                                    <div class="spec-icon-box"><i class="fas fa-plug"></i></div>
                                    <div class="spec-content">
                                        <label class="spec-label">VOLTAGE</label>
                                        <p class="spec-value">{{ getProductSpec($product, 'Voltage') ?: '400/230V' }}</p>
                                    </div>
                                </div>

                                {{-- Price Spec --}}
                                @if($product->price)
                                <div class="spec-item">
                                    <div class="spec-icon-box"><i class="fas fa-tag"></i></div>
                                    <div class="spec-content">
                                        <label class="spec-label">ESTIMATED PRICE</label>
                                        <p class="spec-value">{{ $product->price }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            
                           

                           
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('products.quote-request', $product) }}" class="view-details-btn">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

 
    
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
.power-voltage {
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
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
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
    background: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-hover);
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

/* Showcase Grid Styles */
.products-showcase {
    padding: 6rem 0;
    background-color: #ffffff;
}

.premium-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(550px, 1fr));
    gap: 3rem;
    max-width: 1400px;
    margin: 4rem auto 0;
}

.comparison-card {
    display: flex;
    background: white;
    border-radius: 24px;
    overflow: hidden;
    
    height: 440px;
    
}

.no-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.4);
    gap: 1rem;
    background: rgba(0,0,0,0.1);
}

.no-image-placeholder i {
    font-size: 3rem;
}

.no-image-placeholder span {
    font-size: 0.9rem;
    font-weight: 700;
    text-transform: uppercase;
}



.card-visual {
    flex: 0 0 50%;
    background: linear-gradient(145deg, #374151, #111827);
    position: relative;
    padding: 0;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.visual-header {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    padding: 1.5rem;
    background: linear-gradient(to bottom, rgba(0,0,0,0.6), transparent);
    z-index: 10;
}

.card-tag {
    color: rgba(255,255,255,0.7);
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
    z-index: 10; /* Keep z-index for visibility */
}

.product-model-overlay {
    color: black;
    font-size: 18px; /* Smaller dynamic title text */
    font-weight: 800;
    margin: 0;
    letter-spacing: -0.02em;
    z-index: 10; /* Keep z-index for visibility */
}

.product-render {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.product-render img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1), filter 0.5s ease;
    will-change: transform;
}

.comparison-card:hover .product-render img {
    transform: scale(1.08); /* Sophisticated slow zoom */
    filter: brightness(1.1); /* Subtle lightning to show detail */
}

/* Add a subtle inner glow to the visual side */
.card-visual::after {
    content: '';
    position: absolute;
    inset: 0;
    box-shadow: inset 0 0 80px rgba(0,0,0,0.3);
    pointer-events: none;
    z-index: 5;
}

.card-visual.teal-theme {
    background: linear-gradient(145deg, #134e4a, #064e3b); /* Teal/Dark Green flavor */
}

.visual-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
    z-index: 10;
}

.feature-badges {
    display: flex;
    gap: 0.5rem;
}

.feature-badges span {
    background: white;
    color: #1f2937;
    padding: 5px 14px;
    border-radius: 50px;
    font-size: 0.65rem;
    font-weight: 800;
    letter-spacing: 0.02em;
}

.brand-brand {
    color: white;
    font-size: 0.6rem;
    font-weight: 900;
    letter-spacing: 0.1em;
    display: flex;
    align-items: center;
    gap: 5px;
}

.card-details {
    flex: 1;
    padding: 2rem; /* Tightened padding */
    display: flex;
    flex-direction: column;
}

.spec-grid {
    display: flex;
    flex-direction: column;
    gap: 1.25rem; /* Tightened gap */
    flex: 1;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}


.spec-icon-box {
    width: 38px;
    height: 38px;
    background: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 1rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.04);
    flex-shrink: 0;
    border: 1px solid #f1f5f9;
}

.spec-content {
    display: flex;
    flex-direction: column;
    gap: 1px;
}

.spec-label {
    font-size: 0.65rem;
    font-weight: 800;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin: 0;
}

.spec-value {
    font-size: 0.95rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    line-height: 1.2;
}

.card-actions {
    margin-top: auto;
    display: flex;
    justify-content: flex-start;
}

.view-details-btn {
    background: var(--primary-color);
    color: white;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s ease;
    
}

.view-details-btn:hover {
    background: var(--primary-hover);
    /* transform: scale(1.05);
    box-shadow: 0 6px 16px rgba(59,130,246,0.4); */
}

@media (max-width: 1024px) {
    .comparison-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .comparison-card {
        flex-direction: column;
        height: auto;
    }
    .card-visual {
        height: 250px;
    }
}
</style>


