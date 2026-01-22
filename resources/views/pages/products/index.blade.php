<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - CasaGenerators</title>
    <meta name="description" content="Explore our comprehensive range of generator solutions, from high-power industrial units to commercial and residential generators.">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="{{asset('css/product-bottom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('landing.sections.header')
    
    @include('pages.products.sections.hero')
    
    <div class="product-page-container">
        <div class="product-page-layout">
            <!-- Sidebar Filters -->
            <aside class="product-sidebar">
                <div class="filter-panel">
                    <div class="filter-header">
                        <h3 class="filter-title">
                            <i class="fas fa-sliders-h"></i> Filters
                        </h3>
                        @if(request()->anyFilled(['fuel', 'frequency', 'voltage', 'emissions', 'version', 'engine']))
                            <a href="{{ route('products.index') }}" class="clear-filters-btn">Clear All</a>
                        @endif
                    </div>
                    
                    <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                        <!-- Fuel Filter -->
                        @if($fuels->count() > 0)
                        <div class="filter-group">
                            <h4 class="filter-group-title">Fuel</h4>
                            <div class="filter-options">
                                @foreach($fuels as $fuel)
                                <label class="filter-option">
                                    <input type="checkbox" name="fuel[]" value="{{ $fuel }}" class="filter-radio" {{ in_array($fuel, request()->input('fuel', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                    <span class="filter-label">{{ $fuel }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Frequency Filter -->
                        @if($frequencies->count() > 0)
                        <div class="filter-group">
                            <h4 class="filter-group-title">Frequency</h4>
                            <div class="filter-options">
                                @foreach($frequencies as $freq)
                                <label class="filter-option">
                                    <input type="checkbox" name="frequency[]" value="{{ $freq }}" class="filter-radio" {{ in_array($freq, request()->input('frequency', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                    <span class="filter-label">{{ $freq }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Voltage Filter -->
                        @if($voltages->count() > 0)
                        <div class="filter-group">
                            <h4 class="filter-group-title">Voltage</h4>
                            <div class="filter-options">
                                @foreach($voltages as $volt)
                                <label class="filter-option">
                                    <input type="checkbox" name="voltage[]" value="{{ $volt }}" class="filter-radio" {{ in_array($volt, request()->input('voltage', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                    <span class="filter-label">{{ $volt }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                         <!-- Emissions Filter -->
                         @if($emissions->count() > 0)
                         <div class="filter-group">
                             <h4 class="filter-group-title">Emissions</h4>
                             <div class="filter-options">
                                 @foreach($emissions as $emission)
                                 <label class="filter-option">
                                     <input type="checkbox" name="emissions[]" value="{{ $emission }}" class="filter-radio" {{ in_array($emission, request()->input('emissions', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                     <span class="filter-label">{{ $emission }}</span>
                                 </label>
                                 @endforeach
                             </div>
                         </div>
                         @endif

                         <!-- Version Filter -->
                         @if($versions->count() > 0)
                         <div class="filter-group">
                             <h4 class="filter-group-title">Version</h4>
                             <div class="filter-options">
                                 @foreach($versions as $version)
                                 <label class="filter-option">
                                     <input type="checkbox" name="version[]" value="{{ $version }}" class="filter-radio" {{ in_array($version, request()->input('version', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                     <span class="filter-label">{{ $version }}</span>
                                 </label>
                                 @endforeach
                             </div>
                         </div>
                         @endif

                         <!-- Engine Filter -->
                         @if($engines->count() > 0)
                         <div class="filter-group">
                             <h4 class="filter-group-title">Engine</h4>
                             <div class="filter-options">
                                 @foreach($engines as $engine)
                                 <label class="filter-option">
                                     <input type="checkbox" name="engine[]" value="{{ $engine }}" class="filter-radio" {{ in_array($engine, request()->input('engine', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                     <span class="filter-label">{{ $engine }}</span>
                                 </label>
                                 @endforeach
                             </div>
                         </div>
                         @endif
                    </form>
                </div>
            </aside>

            <!-- Product Grid -->
           <div class="product-main-content">
    
    <div class="product-results-header">
        <p class="results-count">Showing <span class="count-number">{{ $products->count() }}</span> products of ({{ $products->total() }})</p>
    </div>

 @if($products->isEmpty())
    <div class="empty-state-wrapper">
        <div class="empty-state-content">
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            
            <h3>No products found</h3>
            <p>We couldn't find what you're looking for. <br> Try adjusting your search or filters.</p>
            
            <a href="{{ route('products.index') }}" class="btn-clear-filter">
                Clear All Filters
            </a>
        </div>
    </div>
    @else
        <div class="product-cards-container">
            @foreach($products as $product)
            <div class="product-card-horizontal">
                
                <!-- Left Side: Image Section (40%) -->
                <div class="card-image-section">
                    
                    <!-- Product Image -->
                    <a href="{{ route('products.show', $product) }}" class="product-image-link">
                        @if($product->featured_image)
                            <img src="{{ $product->featured_image_url }}" alt="{{ $product->title }}" class="product-image">
                        @else
                            <i class="fas fa-image placeholder-icon"></i>
                        @endif
                    </a>

                    <!-- Badges (Bottom Left) -->
                    <div class="card-badges">
                        @if($product->frequency)
                            <span class="badge">
                                {{ $product->frequency }}
                            </span>
                        @endif
                        @if($product->phases)
                            <span class="badge">
                                {{ Str::limit($product->phases, 1) == '3' ? '3 PHASES' : $product->phases }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Right Side: Details Section (60%) -->
                <div class="card-details-section">
                    
                    <!-- Header -->
                    <h3 class="card-title">
                        <a href="{{ route('products.show', $product) }}">
                            {{ $product->model_code ?? $product->title }}
                        </a>
                    </h3>

                    <!-- Specs Grid -->
                    <div class="specs-grid">
                        
                        <!-- Power Spec -->
                        <div class="spec-column">
                            <div class="spec-label-container">
                                <div class="spec-icon-wrapper">
                                    <i class="fas fa-bolt spec-icon"></i>
                                </div>
                                <span class="spec-label-text">POWER:</span>
                            </div>
                            
                            <div class="spec-value-container">
                                <!-- PRP Power -->
                                @if($product->prime_power_kva || $product->prime_power_kw)
                                <div class="spec-value text-navy">
                                    <span class="spec-prefix">PRP:</span>
                                    {{ $product->prime_power_kva ? (int)$product->prime_power_kva . ' kVA' : '' }}
                                    @if($product->prime_power_kw) 
                                        <span class="spec-sub">({{ (int)$product->prime_power_kw }} kW)</span> 
                                    @endif
                                </div>
                                @endif

                                <!-- ESP Power -->
                                @if($product->standby_power_kva || $product->standby_power_kw)
                                <div class="spec-value text-navy">
                                    <span class="spec-prefix">ESP:</span>
                                    {{ $product->standby_power_kva ? (int)$product->standby_power_kva . ' kVA' : '' }}
                                    @if($product->standby_power_kw) 
                                        <span class="spec-sub">({{ (int)$product->standby_power_kw }} kW)</span> 
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Secondary Specs (Voltage & Emissions) -->
                        <div class="secondary-specs-grid">
                            
                            <!-- Voltage -->
                            <div class="spec-column">
                                <div class="spec-label-container">
                                    <div class="spec-icon-wrapper">
                                        <i class="fas fa-plug spec-icon"></i>
                                    </div>
                                    <span class="spec-label-text">VOLTAGE:</span>
                                </div>
                                <div class="spec-value-container text-navy">
                                    {{ $product->voltage ?: '400/230V' }}
                                </div>
                            </div>

                            <!-- Emissions -->
                            <div class="spec-column spec-column-emissions">
                                <div class="spec-label-container">
                                    <div class="spec-icon-wrapper">
                                        <i class="fas fa-leaf spec-icon"></i>
                                    </div>
                                    <span class="spec-label-text">EMISSIONS:</span>
                                </div>
                                <div class="spec-value-container text-navy">
                                    {{ $product->technical_specifications['general']['emissions_level'] ?? $product->emissions_rating ?? 'Non-Regulated' }}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
        
        <div class="pagination-wrapper">
            {{ $products->links('vendor.pagination.custom') }}
        </div>
    @endif
</div>
        </div>
    </div>

   <section class="casa-brochure-section">
    <div class="container">
        <div class="casa-brochure-wrapper">
            
            <div class="brochure-image-col">
                <img src="{{ asset('images/Product_Services/2-3-1-1.png') }}" alt="Company Brochure" class="img-fluid">
            </div>

            <div class="brochure-content-col">
                <div class="content-inner">
                    <h2 class="section-title">Dedicated Customer Teams & </h2>
                    <h2 class="section-title"><span class="highlight">Agile Services</span></h2>

                    <p class="section-desc">
                        Our worldwide presence ensures the timeliness, cost efficiency, and compliance adherence required to ensure your production timelines are met efficiently.
                    </p>
                    
                    <div class="btn-wrapper">
                        <a href="{{ asset('images/Product_Services/Company-Brochure.pdf') }}" download class="btn-casa-download">
                            Download Brochure
                            <i class="fa-solid fa-download"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
        
    <!-- @include('pages.products-services.sections.cta') -->
    
    @include('landing.sections.footer')
    
    <script src="{{ asset('js/landing.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterTitles = document.querySelectorAll('.filter-group-title');
            
            filterTitles.forEach(title => {
                title.addEventListener('click', function() {
                    const group = this.closest('.filter-group');
                    group.classList.toggle('collapsed');
                });
            });
        });
    </script>
</body>
</html>