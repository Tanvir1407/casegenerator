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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
                    
                    {{-- <div class="view-toggles">
                         <button class="view-btn active"><i class="fas fa-list"></i></button>
                         <button class="view-btn"><i class="fas fa-th-large"></i></button>
                    </div> --}}
                </div>

                @if($products->isEmpty())
                    <div class="no-results-state">
                        <i class="fas fa-search no-results-icon"></i>
                        <h3 class="no-results-title">No products found</h3>
                        <p class="no-results-text">Try adjusting your filters.</p>
                        <a href="{{ route('products.index') }}" class="clear-filters-link">Clear Filters</a>
                    </div>
                @else
                    <div class="products-list-grid">
                        @foreach($products as $product)
                        <div class="product-card-horizontal">
                            <!-- Card Left: Image & Badges -->
                            <div class="card-visual-section">
                                @if($product->power_range)
                                <div class="power-range-badge">
                                    {{ $product->power_range }}
                                </div>
                                @endif
                                
                                <div class="product-image-container">
                                    @if($product->featured_image)
                                        <img src="{{ $product->featured_image_url }}" alt="{{ $product->title }}" 
                                             class="product-main-image"
                                             onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=No+Image';">
                                    @else
                                        <div class="placeholder-image-container">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="visual-footer-badges">
                                    @if($product->frequency)
                                    <span class="spec-chip">{{ $product->frequency }}</span>
                                    @endif
                                    @if($product->phases)
                                    <span class="spec-chip">{{ $product->phases }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Card Right: Details -->
                            <div class="card-info-section">
                                <h3 class="product-post-title">{{ $product->title }}</h3>
                                
                                <div class="product-specs-list">
                                    <div class="spec-row-item">
                                        <div class="spec-icon-wrapper"><i class="fas fa-bolt"></i></div>
                                        <div class="spec-data">
                                            <span class="spec-header">Power</span>
                                            <div class="spec-body">
                                                @if($product->power_prp) <span class="power-val">PRP: {{ $product->power_prp }}</span>@endif
                                                @if($product->power_esp) <span class="power-val">ESP: {{ $product->power_esp }}</span>@endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="spec-row-item">
                                        <div class="spec-icon-wrapper"><i class="fas fa-plug"></i></div>
                                        <div class="spec-data">
                                            <span class="spec-header">Voltage</span>
                                            <span class="spec-body-text">{{ $product->voltage ?: '400/230V' }}</span>
                                        </div>
                                    </div>

                                    @if($product->emissions_rating)
                                    <div class="spec-row-item">
                                        <div class="spec-icon-wrapper"><i class="fas fa-leaf"></i></div>
                                        <div class="spec-data">
                                            <span class="spec-header">Emissions</span>
                                            <span class="spec-body-text">{{ $product->emissions_rating }}</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="card-action-footer">
                                    @if($product->pdf_file)
                                        <a href="{{ route('products.download-pdf', $product) }}" class="download-sheet-link">
                                            Download data sheet <i class="fas fa-download"></i>
                                        </a>
                                    @else
                                        <span class="sheet-unavailable">Data sheet unavailable</span>
                                    @endif
                                    
                                    
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
        
    @include('pages.products-services.sections.cta')
    
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