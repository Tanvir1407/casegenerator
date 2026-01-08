<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Quote - {{ $product->title }} - Casa Generators</title>
    <meta name="description" content="Request a personalized quote for {{ $product->title }} from Casa Generators">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Enhanced Header with Mobile Menu -->
    <header class="main-header">
        <div class="container">
            <nav class="navbar">
                <a href="/" class="logo">
                    <img src="{{ asset('images/Logo/Casagenerators Logo (1).png') }}" alt="Casagenerators Logo" class="logo-image">
                </a>
                
                <!-- Mobile Menu Toggle -->
                <div class="menu-toggle" id="menuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <ul class="nav-menu" id="navMenu">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('products-services') }}">Products & Services</a></li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('awards') }}">Awards & Certificates</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <a href="{{ route('home') }}#contact-form" class="btn btn-primary header-cta-btn">Request a Quote</a>
            </nav>
        </div>
    </header>

    
    <section class="quote-hero">
        
        <div class="container">
           
            
            <h1 class="page-title">{{ $product->title }}</h1>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

        </div>
    </section>

<section class="quote-request-section">
    <div class="container">
        <div class="quote-grid">
            <div class="quote-form-container">
                

                <div class="product-image">
                        @if($product->featured_image)
                            <img src="{{ $product->featured_image_url }}" 
                                 alt="{{ $product->image_alt_text ?: $product->title }}" 
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 400 300%27%3E%3Crect fill=%27%23f3f4f6%27 width=%27400%27 height=%27300%27/%3E%3Cg fill=%27%239ca3af%27%3E%3Cpath d=%27M150 90h100v50H150z%27 opacity=%270.3%27/%3E%3Ccircle cx=%27200%27 cy=%27150%27 r=%2730%27/%3E%3Cpath d=%27M185 150l10 10 20-20%27 stroke=%27%23f3f4f6%27 stroke-width=%273%27 fill=%27none%27/%3E%3C/g%3E%3Ctext x=%27200%27 y=%27230%27 text-anchor=%27middle%27 font-family=%27Arial%27 font-size=%2714%27 fill=%27%239ca3af%27%3EProduct Image%3C/text%3E%3C/svg%3E';">   
                        @endif
                              
                    </div>

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
            </div>

            <div class="product-summary">
                <div class="summary-card">
                    <h3>Product Summary</h3>
                    
                    @if($product->featured_image)
                        <div class="product-image">
                            <img src="{{ $product->featured_image_url }}" 
                                 alt="{{ $product->image_alt_text ?: $product->title }}">
                        </div>
                    @endif

                    <div class="product-info">
                        <h4>{{ $product->title }}</h4>
                        
                        @if($product->category)
                            <span class="category-badge">{{ $product->category }}</span>
                        @endif

                        @if($product->short_description)
                            <p class="description">{{ $product->short_description }}</p>
                        @endif

                        <div class="product-details">
                            @if($product->power_range)
                                <div class="detail-item">
                                    <i class="fas fa-bolt"></i>
                                    <span>{{ $product->power_range }}</span>
                                </div>
                            @endif

                            @if($product->price)
                                <div class="detail-item price">
                                    <i class="fas fa-tag"></i>
                                    <span>{{ $product->formatted_price }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="product-actions">
                            <!-- <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye"></i>
                                View Full Details
                            </a> -->
                            @if($product->hasPdfFile())
                                <a href="{{ route('products.download-pdf', $product) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-file-pdf"></i>
                                    Download PDF
                                </a>
                            @else
                                <div class="btn btn-outline-secondary disabled" title="PDF format not available for this product">
                                    <i class="fas fa-file-slash"></i>
                                    PDF Not Available
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

               
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
                 <div class="contact-card">
                    <h3>Need Help?</h3>
                    <p>Our team is here to help you find the perfect generator solution.</p>
                    
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong>Phone</strong>
                                <span>+1 (555) 123-4567</span>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email</strong>
                                <span>sales@casagenerators.com</span>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <strong>Business Hours</strong>
                                <span>Mon - Fri: 8:00 AM - 6:00 PM</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-block">
                        Contact Us Directly
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.quote-hero {
    background: linear-gradient(135deg, #043B72, #4FA3E3);
    color: white;
    padding: 120px  100px;
    position: relative;
    text-align: center;
}

.quote-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
    opacity: 0.1;
    pointer-events: none;
}

.breadcrumb {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    list-style: none;
    padding: 0;
    margin-bottom: 25px;
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
}
.breadcrumb-item {
    list-style-type: none;
}

.page-title {
    font-size: 56px;
    font-weight: 800;
    margin-bottom: 20px;
    letter-spacing: -2px;
    line-height: 1.1;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
}

.quote-request-section {
    padding: 4rem 0;
    background: #f9fafb;
}

.quote-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 3rem;
}

.form-card, .summary-card, .contact-card {
    background: white;
    border-radius: 1rem;
    padding: 2rem;
    margin-top: 1.5rem;
    border: 1px solid #e5e7eb;
}

.form-card h2 {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #111827;
}

.form-intro {
    color: #6b7280;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.5rem;
    color: #374151;
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    font-size: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-control.is-invalid {
    border-color: #dc2626;
}

.invalid-feedback {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-note {
    text-align: center;
    color: #6b7280;
    font-size: 0.875rem;
    margin-top: 1rem;
    margin-bottom: 0;
}

.alert {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.summary-card {
    margin-bottom: 1.5rem;
}

.summary-card h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #111827;
}

.product-image {
    width: 100%;
    
    overflow: hidden;
    
    margin-bottom: 1.5rem;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-info h4 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #111827;
}

.category-badge {
    background: #dbeafe;
    color: #1d4ed8;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
    display: inline-block;
    margin-bottom: 1rem;
}

.description {
    color: #6b7280;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.product-details {
    margin-bottom: 1.5rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    color: #374151;
}

.detail-item.price {
    color: #dc2626;
    font-weight: 600;
}

.detail-item i {
    width: 16px;
    color: #6b7280;
}

.product-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.contact-card h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #111827;
}

.contact-card p {
    color: #6b7280;
    margin-bottom: 1.5rem;
}

.contact-info {
    margin-bottom: 1.5rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    /* margin-bottom: 1rem; */
}

.contact-item i {
    color: var(--primary-color);
    width: 20px;
    margin-top: 0.125rem;
}

.contact-item div {
    display: flex;
    flex-direction: column;
}

.contact-item strong {
    color: #111827;
    margin-bottom: 0.25rem;
}

.contact-item span {
    color: #6b7280;
    font-size: 0.875rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    text-decoration: none;
    text-align: center;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border: 1px solid transparent;
    cursor: pointer;
    font-size: 1rem;
}

.btn-lg {
    padding: 1rem 2rem;
    font-size: 1.125rem;
}

.btn-block {
    width: 100%;
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
    color: var(--primary-color);
    border-color: var(--primary-color);
    background: transparent;
}

.btn-outline-primary:hover {
    background: var(--primary-hover);
    color: white;
}

.btn-outline-secondary {
    color: #6b7280;
    border-color: #d1d5db;
    background: transparent;
}

.btn-outline-secondary:hover {
    background: #f3f4f6;
    color: #374151;
}

.btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
    background: #f3f4f6;
    border-color: #d1d5db;
    color: #9ca3af;
}

@media (max-width: 1024px) {
    .quote-grid {
        grid-template-columns: 1fr;
    }
    
    .product-summary {
        order: -1;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .form-card, .summary-card, .contact-card {
        padding: 1.5rem;
    }
    
    .product-actions {
        flex-direction: column;
    }
}

/* Specifications Card Styling */
.specs-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 2rem;
    
    border: 1px solid #e5e7eb;
    margin-top: 1.5rem;
}

.specs-card h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a202c;
    margin-top: 0;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f7fafc;
    display: flex;
    align-items: center;
    gap: 12px;
}

.specs-card h3 i {
    color: var(--primary-color, #10b981);
    font-size: 1.1rem;
}

.specs-list {
    display: grid;
    gap: 12px;
}

.spec-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 3px;
 
    border-bottom: 2px solid #f7fafc;
}

/* .spec-item:hover {
    background: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    border-color: #e2e8f0;
} */

.spec-label {
    font-size: 0.875rem;
    color: #64748b;
    font-weight: 600;
    letter-spacing: 0.01em;
}

.spec-value {
    font-size: 0.9375rem;
    color: #1e293b;
    font-weight: 700;
    text-align: right;
}

@media (max-width: 480px) {
    .spec-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }
    .spec-value {
        text-align: left;
    }
}

/* Enhanced Header Styles */
.menu-toggle {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    padding: 10px;
    background: transparent;
    border: none;
    z-index: 1001;
}

.menu-toggle span {
    width: 25px;
    height: 3px;
    background: var(--text-dark);
    transition: all 0.3s ease;
    border-radius: 2px;
}

.menu-toggle.active span:nth-child(1) {
    transform: rotate(45deg) translate(8px, 8px);
}

.menu-toggle.active span:nth-child(2) {
    opacity: 0;
}

.menu-toggle.active span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -7px);
}

.header-cta-btn {
    white-space: nowrap;
}

/* Mobile Responsive Header */
@media (max-width: 768px) {
    .nav-menu {
        position: fixed;
        top: 80px;
        left: 0;
        width: 100%;
        flex-direction: column;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(15px);
        padding: 20px;
        gap: 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transform: translateY(-120%);
        transition: transform 0.4s ease;
        z-index: 999;
    }

    .nav-menu.active {
        transform: translateY(0);
    }

    .nav-menu li {
        width: 100%;
        padding: 15px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .nav-menu li:last-child {
        border-bottom: none;
    }

    .nav-menu a {
        color: var(--text-dark) !important;
        display: block;
        width: 100%;
        font-size: 16px;
    }

    .menu-toggle {
        display: flex;
    }

    .navbar .header-cta-btn {
        display: none;
    }

    .logo-image {
        height: 35px;
    }

    .main-header {
        padding: 15px 0;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 36px;
    }
    
    .quote-hero {
        padding: 100px 20px;
    }
}
</style>

    @include('landing.sections.footer')

    <!-- Enhanced Header JavaScript -->
    <script>
        // Mobile menu toggle functionality
        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');

        if (menuToggle && navMenu) {
            menuToggle.addEventListener('click', function() {
                navMenu.classList.toggle('active');
                menuToggle.classList.toggle('active');
            });

            // Close mobile menu when clicking on a menu item
            document.querySelectorAll('.nav-menu a').forEach(link => {
                link.addEventListener('click', function() {
                    navMenu.classList.remove('active');
                    menuToggle.classList.remove('active');
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideNav = navMenu.contains(event.target);
                const isClickOnToggle = menuToggle.contains(event.target);
                
                if (!isClickInsideNav && !isClickOnToggle && navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                    menuToggle.classList.remove('active');
                }
            });
        }

        // Sticky header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.main-header');
            const currentScroll = window.pageYOffset;

            if (currentScroll > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.includes('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href.split('#')[1] ? '#' + href.split('#')[1] : href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>