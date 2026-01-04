<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->title }} - Casa Generators</title>
    <meta name="description" content="{{ $product->short_description ?: 'Learn more about ' . $product->title . ' from Casa Generators' }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    @include('landing.sections.header')
    
    <section class="product-hero">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active">{{ $product->title }}</li>
            </ol>
        </nav>
        
        <div class="product-header">
            <div class="product-title-section">
                @if($product->category)
                    <span class="category-badge">{{ $product->category }}</span>
                @endif
                
                <h1 class="product-title">{{ $product->title }}</h1>
                
                @if($product->short_description)
                    <p class="product-subtitle">{{ $product->short_description }}</p>
                @endif
                
                <div class="product-meta">
                    @if($product->power_range)
                        <span class="meta-item">
                            <i class="fas fa-bolt"></i> {{ $product->power_range }}
                        </span>
                    @endif
                    
                    @if($product->price)
                        <span class="meta-item price">{{ $product->formatted_price }}</span>
                    @endif
                </div>
                
                <div class="product-actions">
                    <a href="{{ route('products.quote-request', $product) }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-file-alt"></i> Request Quote
                    </a>
                    @if($product->hasPdfFile())
                        <a href="{{ route('products.download-pdf', $product) }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-file-pdf"></i> {{ $product->pdf_title ?: 'Download PDF' }}
                        </a>
                    @else
                        <div class="btn btn-outline-light btn-lg disabled" title="PDF format not available for this product">
                            <i class="fas fa-file-slash"></i> PDF Not Available
                        </div>
                    @endif
                </div>
            </div>
            
            @if($product->featured_image)
                <div class="product-featured-image">
                    <img src="{{ $product->featured_image_url }}" 
                         alt="{{ $product->image_alt_text ?: $product->title }}"
                         class="featured-img">
                </div>
            @endif
        </div>
    </div>
</section>

<article class="product-details">
    <div class="container">
        <div class="product-content-grid">
            <div class="main-content">
                <section class="product-description">
                    <h2>Product Description</h2>
                    <div class="rich-content">
                        {!! $product->description !!}
                    </div>
                </section>
                
                @if($product->features && count($product->features) > 0)
                <section class="product-features">
                    <h2>Key Features</h2>
                    <ul class="features-list">
                        @foreach($product->features as $feature)
                            @if(isset($feature['feature']) && $feature['feature'])
                                <li>{{ $feature['feature'] }}</li>
                            @endif
                        @endforeach
                    </ul>
                </section>
                @endif
                
                @if($product->gallery_images && count($product->gallery_images) > 0)
                <section class="product-gallery">
                    <h2>Gallery</h2>
                    <div class="gallery-grid">
                        @foreach($product->gallery_images as $image)
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $image) }}" 
                                     alt="{{ $product->title }} gallery image"
                                     loading="lazy"
                                     onclick="openImageModal('{{ asset('storage/' . $image) }}')"
                                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 300 300%27%3E%3Crect fill=%27%23f3f4f6%27 width=%27300%27 height=%27300%27/%3E%3Cg fill=%27%239ca3af%27%3E%3Ccircle cx=%27150%27 cy=%27150%27 r=%2740%27/%3E%3Cpath d=%27M130 150l15 15 25-30%27 stroke=%27%23f3f4f6%27 stroke-width=%274%27 fill=%27none%27/%3E%3C/g%3E%3Ctext x=%27150%27 y=%27240%27 text-anchor=%27middle%27 font-family=%27Arial%27 font-size=%2714%27 fill=%27%239ca3af%27%3EGallery Image%3C/text%3E%3C/svg%3E';">
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>
            
            <aside class="sidebar">
                @if($product->specifications && count($product->specifications) > 0)
                <div class="specs-card">
                    <h3><i class="fas fa-microchip"></i> Specifications</h3>
                    <div class="specs-list">
                        @foreach($product->specifications as $spec)
                            @if(isset($spec['spec_name']) && isset($spec['spec_value']) && $spec['spec_name'] && $spec['spec_value'])
                                <div class="spec-item">
                                    <span class="spec-label">{{ $spec['spec_name'] }}</span>
                                    <span class="spec-value">{{ $spec['spec_value'] }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="quote-card">
                    <h3>Interested in this product?</h3>
                    <p>Get a personalized quote tailored to your specific needs.</p>
                    <a href="{{ route('products.quote-request', $product) }}" class="btn btn-primary btn-block">
                        Request Quote
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-block">
                        Contact Us
                    </a>
                </div>
                
                <div class="info-card">
                    <h3>Product Information</h3>
                    <ul class="info-list">
                        <li><strong>Product ID:</strong> {{ $product->id }}</li>
                        @if($product->category)
                            <li><strong>Category:</strong> {{ $product->category }}</li>
                        @endif
                        @if($product->power_range)
                            <li><strong>Power Range:</strong> {{ $product->power_range }}</li>
                        @endif
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</article>

<!-- Image Modal -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <span class="close-modal">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<style>
.product-hero {
    background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
    color: white;
    padding: 2rem 0 4rem 0;
}

.breadcrumb {
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    margin-bottom: 2rem;
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: white;
}

.product-header {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 3rem;
    align-items: center;
}

.category-badge {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 500;
    display: inline-block;
    margin-bottom: 1rem;
}

.product-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.product-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    line-height: 1.5;
}

.product-meta {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.meta-item.price {
    font-size: 1.25rem;
    color: #fbbf24;
}

.product-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.product-featured-image {
    max-width: 400px;
}

.featured-img {
    width: 100%;
    height: auto;
    border-radius: 1rem;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
}

.product-details {
    padding: 4rem 0;
}

.product-content-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 3rem;
}

.main-content section {
    margin-bottom: 3rem;
}

.main-content h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #111827;
}

.rich-content {
    line-height: 1.7;
    color: #374151;
}

.rich-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 1rem 0;
}

.features-list {
    list-style: none;
    padding: 0;
}

.features-list li {
    padding: 0.75rem 0;
    border-bottom: 1px solid #e5e7eb;
    position: relative;
    padding-left: 2rem;
}

.features-list li:before {
    content: '✓';
    position: absolute;
    left: 0;
    top: 0.75rem;
    color: #059669;
    font-weight: bold;
    font-size: 1.1rem;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.gallery-item {
    aspect-ratio: 1;
    overflow: hidden;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: scale(1.05);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sidebar > div {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.sidebar h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #111827;
}

/* Specifications Card Styling */
.specs-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 24px !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
    border: 1px solid #eef2f6 !important;
}

.specs-card h3 {
    font-size: 1.25rem !important;
    font-weight: 700 !important;
    color: #1a202c !important;
    margin-top: 0 !important;
    margin-bottom: 20px !important;
    padding-bottom: 12px !important;
    border-bottom: 2px solid #f7fafc !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}

.specs-card h3 i {
    color: var(--primary-color, #3b82f6);
    font-size: 1.1rem;
}

.specs-list {
    display: grid !important;
    gap: 12px !important;
}

.spec-item {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    padding: 12px 16px !important;
    background: #f8fafc !important;
    border-radius: 10px !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    border: 1px solid transparent !important;
}

.spec-item:hover {
    background: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
    border-color: #e2e8f0 !important;
}

.spec-label {
    font-size: 0.875rem !important;
    color: #64748b !important;
    font-weight: 600 !important;
    letter-spacing: 0.01em !important;
}

.spec-value {
    font-size: 0.9375rem !important;
    color: #1e293b !important;
    font-weight: 700 !important;
    text-align: right !important;
}

@media (max-width: 480px) {
    .spec-item {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 4px !important;
    }
    .spec-value {
        text-align: left !important;
    }
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

.btn-lg {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

.btn-block {
    width: 100%;
    display: block;
    margin-bottom: 0.75rem;
}

.btn-primary {
    background: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background: #2563eb;
    color: white;
}

.btn-outline-light {
    color: white;
    border-color: rgba(255, 255, 255, 0.5);
    background: transparent;
}

.btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.1);
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

.btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
    border-color: rgba(255, 255, 255, 0.3) !important;
    color: rgba(255, 255, 255, 0.5) !important;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f3f4f6;
    font-size: 0.9rem;
}

.info-list li:last-child {
    border-bottom: none;
}

/* Image Modal */
.image-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    max-height: 80%;
    object-fit: contain;
}

.close-modal {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
    cursor: pointer;
}

.close-modal:hover {
    color: #bbb;
}

@media (max-width: 1024px) {
    .product-content-grid {
        grid-template-columns: 1fr;
    }
    
    .sidebar {
        order: -1;
    }
}

@media (max-width: 768px) {
    .product-header {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .product-title {
        font-size: 2rem;
    }
    
    .product-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<script>
function openImageModal(src) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImg.src = src;
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Close modal when clicking outside the image
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>

@include('landing.sections.footer')
</body>
</html>