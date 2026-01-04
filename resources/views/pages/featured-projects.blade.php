<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects - CasaGenerators</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Featured Projects Page - Header Override */
        .main-header {
            background-color: #ffffff !important;
            background: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        
        .main-header .navbar {
            background-color: #ffffff !important;
        }
        
        .main-header .logo-text {
            color: #0f172a !important;
        }
        
        .main-header .logo-primary {
            color: var(--primary-color) !important;
        }
        
        .main-header .nav-menu a {
            color: #1e293b !important;
        }
    </style>
</head>
<body>
    @include('landing.sections.header')

    <!-- All Projects Section with Generator Products Card Design -->
    <section class="all-projects-section">
        <style>
            .all-projects-section {
                padding: 80px 0;
                background-color: #ffffff;
                font-family: 'Instrument Sans', sans-serif;
            }

            .ap-container {
                max-width: 1600px;
                margin: 66px auto;
                padding: 0 20px;
            }

            /* Grid */
            .ap-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 40px;
                margin-bottom: 50px;
            }

            @media (max-width: 1024px) {
                .ap-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 768px) {
                .ap-grid {
                    grid-template-columns: 1fr;
                }
            }

            /* Card Container */
            .ap-card {
                display: flex;
                flex-direction: column;
                background: transparent;
            }

            /* Image Box */
            .ap-image-wrapper {
                position: relative;
                width: 100%;
                aspect-ratio: 504 / 491;
                border-radius: 20px;
                overflow: hidden;
                background: #f0f0f0;
                margin-bottom: 24px;
                isolation: isolate;
            }

            .ap-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.8s cubic-bezier(0.25, 1, 0.5, 1);
                will-change: transform;
            }

            .ap-card:hover .ap-image {
                transform: scale(1.25);
            }

            /* Title Overlay on Hover */
            .ap-image-wrapper .ap-desc {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                margin: 0;
                padding: 30px;
                background: rgba(255, 255, 255, 0.95);
                transform: translateY(100%);
                opacity: 0;
                transition: all 0.5s cubic-bezier(0.25, 1, 0.5, 1);
                box-shadow: 0 -10px 40px rgba(249, 156, 27, 0.4);
                z-index: 10;
            }

            .ap-card:hover .ap-image-wrapper .ap-desc {
                transform: translateY(0);
                opacity: 1;
            }

            /* Badge Styling */
            .ap-badge {
                position: absolute;
                top: 0;
                right: 0;
                background-color: #ffffff;
                padding: 18px 25px;
                border-bottom-left-radius: 20px;
                z-index: 20;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                min-width: 180px;
                box-shadow: -2px 2px 10px rgba(0,0,0,0.05);
            }

            /* Corner Blend SVG (Left of Badge) */
            .ap-badge-blend-left {
                position: absolute;
                top: -2px;
                left: -18px;
                width: 20px;
                height: 20px;
                z-index: 20;
                pointer-events: none;
                rotate: 270deg;
            }

            .ap-badge-blend-right {
                position: absolute;
                bottom: -18px;
                right: -2px;
                width: 20px;
                height: 20px;
                z-index: 20;
                pointer-events: none;
                rotate: 267deg;
            }

            .blend-path {
                fill: #ffffff;
            }

            .ap-badge-label {
                font-size: 13px;
                color: var(--primary-color);
                font-weight: 700;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                margin-top: 3px;
                font-family: 'Instrument Sans', sans-serif;
                display: flex;
                align-items: center;
                gap: 11px;
            }

            .ap-badge-category {
                font-size: 13px;
                color: var(--primary-color);
                font-weight: 800;
                text-transform: uppercase;
                display: flex;
                align-items: center;
                gap: 10px;
                font-family: 'Instrument Sans', sans-serif;
            }

            .ap-badge-icon {
                width: 24px;
                height: 24px;
                stroke-width: 1.5;
                color: var(--primary-color);
            }

            .ap-badge-icon.fill-icon {
                fill: currentColor;
                stroke: none;
            }

            /* Text Content */
            .ap-desc {
                font-size: 1.25rem;
                line-height: 1.4;
                color: #1e293b;
                font-weight: 500;
                margin: 0;
                letter-spacing: -0.01em;
            }

            /* Section Header */
            .ap-header {
                text-align: center;
                max-width: 800px;
                margin: 0 auto 60px auto;
            }

            .ap-subtitle {
                display: inline-block;
                color: black;
                font-size: 13px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 15px;
                background:var(--primary-color);
                padding: 6px 12px;
                border-radius: 30px;
            }

            .ap-title {
                font-size: 3rem;
                font-weight: 700;
                color: #0f172a;
                line-height: 1.1;
                letter-spacing: -0.02em;
                margin: 0;
            }

            @media (max-width: 768px) {
                .ap-title {
                    font-size: 2.25rem;
                }
                .ap-header {
                    margin-bottom: 40px;
                }
            }
        </style>

        <div class="ap-container">
            <!-- Section Header -->
            <div class="ap-header">
                <span class="ap-subtitle">All Projects</span>
                <h1 class="ap-title">Our Featured <span style="color: var(--primary-color);">Projects</span></h1>
            </div>

            <div class="ap-grid">
                @foreach($projects as $project)
                <div class="ap-card">
                    <div class="ap-image-wrapper">
                        @if($project->featured_image && $project->featured_image_url)
                            <img src="{{ $project->featured_image_url }}" alt="{{ $project->image_alt_text ?? $project->title }}" class="ap-image"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 400 300%27%3E%3Crect fill=%27%23f3f4f6%27 width=%27400%27 height=%27300%27/%3E%3Cg fill=%27%239ca3af%27%3E%3Cpath d=%27M100 80h200v140H100z%27 opacity=%270.3%27/%3E%3Cpath d=%27M140 110h120v20H140z%27/%3E%3Cpath d=%27M140 145h80v8H140z%27/%3E%3Ccircle cx=%27160%27 cy=%27180%27 r=%2712%27/%3E%3Ccircle cx=%27190%27 cy=%27180%27 r=%2712%27/%3E%3Ccircle cx=%27220%27 cy=%27180%27 r=%2712%27/%3E%3C/g%3E%3Ctext x=%27200%27 y=%27240%27 text-anchor=%27middle%27 font-family=%27Arial%27 font-size=%2716%27 fill=%27%239ca3af%27%3EProject Image%3C/text%3E%3C/svg%3E';">
                        @else
                            <img src="{{ asset('images/placeholder.png') }}" alt="{{ $project->title }}" class="ap-image">
                        @endif
                        
                        <!-- Badge -->
                        <div class="ap-badge">
                            <!-- Corner Blend SVG -->
                            <div class="ap-badge-blend-left">
                                <svg class="svgcorner" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38">
                                    <g id="Capa_1-2" data-name="Capa 1">
                                        <path class="blend-path" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="ap-badge-blend-right">
                                <svg class="svgcorner svgcorner--2" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38">
                                    <g id="Capa_1-2" data-name="Capa 1">
                                        <path class="blend-path" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path>
                                    </g>
                                </svg>
                            </div>

                            <div class="ap-badge-category">
                                <svg class="ap-badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <path d="M12 1v6m0 6v6"></path>
                                    <path d="M4.22 4.22l4.24 4.24m2.12 2.12l4.24 4.24"></path>
                                    <path d="M1 12h6m6 0h6"></path>
                                    <path d="M4.22 19.78l4.24-4.24m2.12-2.12l4.24-4.24"></path>
                                </svg>
                                {{ $project->status ?? 'Project' }}
                            </div>
                            <span class="ap-badge-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                                {{ $project->location ?? 'Location not specified' }}
                            </span>
                        </div>
                        <p class="ap-desc">
                            {{ $project->title }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    @include('landing.sections.footer')
    
    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>
