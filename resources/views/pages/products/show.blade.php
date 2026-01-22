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
    <link rel="stylesheet" href="{{ asset('css/landing.css')}}">
    <link rel="stylesheet" href="{{ asset('css/pages.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body >
    @include('landing.sections.header')
    <div class="product-detail-body">
    <div class="product-detail-wrapper">
        <div class="container">
            
            <!-- Top Section: Image + Info -->
            <div class="product-top-grid">
                
                <!-- Left: Image -->
                <div class="product-image-area">
                    <div class="main-image-container">
                        @if($product->featured_image)
                            <img id="mainProductImage" src="{{ $product->featured_image_url }}" alt="{{ $product->title }}" onclick="openImageModal(this.src)">
                        @else
                            <div class="no-image-placeholder">
                                <i class="fas fa-image"></i>
                                <span>No Image Available</span>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnails -->
                    @if($product->gallery_images && count($product->gallery_images) > 0)
                    <div class="thumbnails-row">
                        @if($product->featured_image)
                        <div class="thumb-item" onclick="updateMainImage('{{ $product->featured_image_url }}')">
                            <img src="{{ $product->featured_image_url }}" alt="Main">
                        </div>
                        @endif
                        @foreach($product->gallery_images as $image)
                        <div class="thumb-item" onclick="updateMainImage('{{ asset('storage/' . $image) }}')">
                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery" onerror="this.parentElement.style.display='none'">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Right: Info -->
                <div class="product-info-area">
                    <h1 class="product-main-title">{{ $product->title }}</h1>
                    
                    @if($product->model_code)
                    <div class="product-model">Model: <strong>{{ $product->model_code }}</strong></div>
                    @endif
                    
                    @if($product->short_description)
                    <p class="product-desc">{{ $product->short_description }}</p>
                    @endif

                    <div >
                        <!-- Power Output -->
                        <div>
                            <div class="info-row-container">
                            <div class="info-row">
                                <div class="info-icon"><i class="fas fa-bolt"></i></div>
                                <div class="info-content">
                                    <span class="info-label">POWER OUTPUT</span>
                                    <div class="info-value">
                                        @if($product->prime_power_kva)
                                            {{ (int)$product->prime_power_kva }} kVA 
                                    @if($product->prime_power_kw) <span class="info-sub">({{ (int)$product->prime_power_kw }} kW)</span> @endif
                                @else
                                    {{ $product->power_range ?? 'N/A' }}
                                @endif
                            </div>
                            @if($product->prime_power_kva)
                            <span class="info-note">Prime Power (PRP)</span>
                            @endif
                            </div>
                        </div>

                        <!-- Application -->
                        <div>
                            <div class="info-row">
                            <div class="info-icon"><i class="fas fa-industry"></i></div>
                            <div class="info-content">
                                <span class="info-label">APPLICATION</span>
                                <div class="info-value">{{ $product->category ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                   </div>
                    <!-- Buttons -->
                    <div class="product-actions">
                        <a href="{{ route('quote') }}" class="btn-primary">Request a Quote</a>
                        @if($product->hasPdfFile())
                        <a href="{{ route('products.download-pdf', $product) }}" class="btn-secondary">
                            <i class="fas fa-file-pdf"></i> Download Datasheet
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        
        
    </div>

    <div class="container last-info">
             <!-- Bottom Content Section -->
            <div class="product-content-layout">
                
                <!-- Left Column -->
                <div class="content-main">

                    <!-- Key Features -->
                    @if($product->features && count($product->features) > 0)
                    <section class="content-section">
                        <h2 class="section-title">
                            Key Features
                        </h2>
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

                <!-- Right Sidebar: Technical Specs -->
                <aside class="content-sidebar">
                    @if($product->technical_specifications)
                    <div class="specs-panel">
                      
                        <div class="specs-body">
                            @php
                                $specs = $product->technical_specifications;
                                $sections = [
                                    'general' => 'GENERAL INFORMATION',
                                    'engine_details' => 'ENGINE DETAILS',
                                    'alternator_details' => 'ALTERNATOR DETAILS',
                                    'fuel_consumption_l_h' => 'FUEL CONSUMPTION',
                                    'dimensions_and_weight' => 'DIMENSIONS',
                                ];
                            @endphp

                            @foreach($sections as $key => $title)
                                @if(isset($specs[$key]) && !empty($specs[$key]))
                                <div class="spec-group">
                                    <div class="spec-group-title">{{ $title }}</div>
                                    @foreach($specs[$key] as $specKey => $specValue)
                                        @if($specValue !== null && $specValue !== '')
                                        <div class="spec-line">
                                            <span class="spec-key">{{ ucwords(str_replace('_', ' ', $specKey)) }}</span>
                                            <span class="spec-val">{{ $specValue }}</span>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </aside>
            </div>

        </div>

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <span class="modal-close">&times;</span>
        <img id="modalImage" class="modal-img">
    </div>
                            </div>
    @include('landing.sections.footer')

    <script>
        function updateMainImage(src) {
            const mainImg = document.getElementById('mainProductImage');
            if (mainImg) {
                mainImg.style.opacity = '0.6';
                setTimeout(() => {
                    mainImg.src = src;
                    mainImg.style.opacity = '1';
                }, 150);
            }
        }

        function openImageModal(src) {
            document.getElementById('imageModal').style.display = 'flex';
            document.getElementById('modalImage').src = src;
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeImageModal();
        });
    </script>
</body>
</html>