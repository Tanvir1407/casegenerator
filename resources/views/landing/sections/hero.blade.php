<section class="hero-section" id="heroCarousel">
    <!-- Hero Slide 1 -->
    <div class="hero-slide active">
        <div class="hero-bg-img" style="background-image: url('{{ asset('images/landing/Dubai-Skyline.jpg') }}');"></div>
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span>Electrical Generators</span>
                </div>
                <h1 class="hero-title">
                    Reliable Power Solutions for Global Infrastructure
                </h1>
                <div class="hero-actions">
                    <a href="{{ route('contact') }}" class="btn-hero-primary">
                            Contact
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Slide 2 -->
    <div class="hero-slide">
        <div class="hero-bg-img" style="background-image: url('{{ asset('images/landing/image002.jpg') }}');"></div>
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span>Electrical Generators</span>
                </div>
                <h1 class="hero-title">
                    High-Performance Low Emissions & Fuel Efficiency
                </h1>
                <div class="hero-actions">
                  
                    <a href="{{ route('contact') }}" class="btn-hero-primary">
                            Contact
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Slide 3 -->
    <div class="hero-slide">
        <div class="hero-bg-img" style="background-image: url('{{ asset('images/landing/image001.jpg') }}');"></div>
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span>Where Power Meets Precision</span>
                </div>
                <h1 class="hero-title">
                    Reliable Backup Generators for Uninterrupted Operations
                </h1>
                <div class="hero-actions">
                    <a href="{{ route('contact') }}" class="btn-hero-primary">
                            Contact
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button class="hero-nav hero-nav-prev" onclick="previousSlide()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <button class="hero-nav hero-nav-next" onclick="nextSlide()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>

    <!-- Slide Indicators -->
    <div class="hero-indicators">
        <button class="indicator active" onclick="currentSlide(1)"></button>
        <button class="indicator" onclick="currentSlide(2)"></button>
        <button class="indicator" onclick="currentSlide(3)"></button>
    </div>
</section>
