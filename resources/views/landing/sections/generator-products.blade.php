

<section class="generator-products-section">
    <style>
        .generator-products-section {
            padding: 80px 0;
            background-color: #ffffff;
            font-family: 'Instrument Sans', sans-serif;
        }

        .gps-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Grid */
        .gps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px; /* Increased gap for better separation */
            margin-bottom: 50px;
        }

        @media (max-width: 1024px) {
            .gps-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .gps-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Card Container */
        .gps-card {
            display: flex;
            flex-direction: column;
            background: transparent;
            /* No border/shadow on the entire card, text floats under image box */
        }

        /* Image Box */
        .gps-image-wrapper {
            position: relative;
            width: 504px;
            height: 491px;
            aspect-ratio: 4/3; 
            border-radius: 20px;
            overflow: hidden; /* Clips the image */
            background: #f0f0f0;
            margin-bottom: 24px;
            /* To allow Badge to overlap if needed, we might need overflow visible. 
               But image needs radius. Usually solved by putting badge inside. */
             isolation: isolate; 
        }

        /* Title Overlay on Hover */
        .gps-image-wrapper .gps-desc {
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

        .gps-card:hover .gps-image-wrapper .gps-desc {
            transform: translateY(0);
            opacity: 1;
        }

        .gps-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.25, 1, 0.5, 1);
            will-change: transform;
        }

        .gps-card:hover .gps-image {
            transform: scale(1.25);
        }

        /* Badge Styling */
        .gps-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #ffffff;
            /* Badge sizing */
            padding: 18px 25px;
            /* Border radius: Bottom-Left is rounded (Convex) */
            border-bottom-left-radius: 20px;
            z-index: 20;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            min-width: 180px;
            box-shadow: -2px 2px 10px rgba(0,0,0,0.05); /* Subtle shadow for depth */
        }

        /* Corner Blend SVG (Left of Badge) */
        .gps-badge-blend-left {
            position: absolute;
            top: -2px;
            left: -18px; 
            width: 20px;
            height: 20px;
            z-index: 20;
            pointer-events: none;
            rotate:270deg;
        }
        .gps-badge-blend-right{
            position: absolute;
            bottom: -18px;
            right: -2px; 
            width: 20px;
            height: 20px;
            z-index: 20;
            pointer-events: none;
            rotate:267deg;
        }
        
        .blend-path {
            fill: #ffffff;
        }

        .gps-badge-label {
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
        
        .gps-badge-category {
            font-size: 13px;
            color: var(--primary-color); /* Bright Blue */
            font-weight: 800;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Instrument Sans', sans-serif;
        }
        
        .gps-badge-icon {
            width: 24px;
            height: 24px;
            stroke-width: 1.5;
            color: var(--primary-color);
        }
        
        /* Icon styles specific to fill vs stroke if needed */
        .gps-badge-icon.fill-icon {
             fill: currentColor;
             stroke: none;
        }

        /* Text Content */
        .gps-desc {
            font-size: 1.25rem; /* Larger text as per screenshot */
            line-height: 1.4;
            color: #1e293b; /* Dark Slate */
            font-weight: 500;
            margin: 0;
            letter-spacing: -0.01em;
        }

        /* Section Header */
        .gps-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 60px auto;
        }

        .gps-subtitle {
            display: inline-block;
            color: black;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            background: var(--primary-color);
            padding: 6px 12px;
            border-radius: 30px;
            text-align: left;
        }

        .gps-title {
            font-size: 3rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin: 0;
        }

        @media (max-width: 768px) {
            .gps-title {
                font-size: 2.25rem;
            }
            .gps-header {
                margin-bottom: 40px;
            }
        }

        /* See All Button */
        .gps-btn-container {
            text-align: center;
            margin-top: 50px;
        }

        .gps-btn {
            display: inline-flex;
            align-items: center;
            margin-top: 50px;
            justify-content: center;
            background-color: var(--primary-color);
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 700;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 16px;
        }

        .gps-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-3px);
            /* box-shadow: 0 8px 25px rgba(204, 51, 102, 0.45); */
        }

        .gps-btn-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            background-color: rgba(0, 0, 0, 0.15);
            border-radius: 50%;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), background-color 0.3s;
        }

        .gps-btn:hover .gps-btn-icon {
            transform: translateX(8px); /* Slide icon to right */
            background-color: rgba(0, 0, 0, 0.25);
        }

        .gps-btn-icon svg {
            width: 18px;
            height: 18px;
        }
    </style>

    <div class="gps-container">
        <!-- Section Header -->
        <div class="gps-header">
            <span class="gps-subtitle">Explore Recent Works</span>
            <h2 class="gps-title">Featured <span style="color: var(--primary-color);">Projects</span></h2>
        </div>

        <div class="gps-grid">
            @forelse($featuredProjects->take(3) as $project)
           
            <!-- Dynamic Project Card -->
            <div class="gps-card">
                <div class="gps-image-wrapper">
                    <img src="{{ $project->featured_image_url ?? asset('images/placeholder.png') }}" 
                         alt="{{ $project->image_alt_text ?? $project->title }}" 
                         class="gps-image"
                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 400 300%27%3E%3Crect fill=%27%23f3f4f6%27 width=%27400%27 height=%27300%27/%3E%3Cg fill=%27%239ca3af%27%3E%3Cpath d=%27M100 80h200v140H100z%27 opacity=%270.3%27/%3E%3Cpath d=%27M140 110h120v20H140z%27/%3E%3Cpath d=%27M140 145h80v8H140z%27/%3E%3Ccircle cx=%27160%27 cy=%27180%27 r=%2712%27/%3E%3Ccircle cx=%27190%27 cy=%27180%27 r=%2712%27/%3E%3Ccircle cx=%27220%27 cy=%27180%27 r=%2712%27/%3E%3C/g%3E%3Ctext x=%27200%27 y=%27240%27 text-anchor=%27middle%27 font-family=%27Arial%27 font-size=%2716%27 fill=%27%239ca3af%27%3EProject Image%3C/text%3E%3C/svg%3E';">
                    
                    <!-- Badge -->
                    <div class="gps-badge">
                        <!-- Corner Blend SVG -->
                        <div class="gps-badge-blend-left">
                            <svg class="svgcorner" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38"> <g id="Capa_1-2" data-name="Capa 1"> <path class="cls-1" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path> </g> </svg>
                        </div>
                        <div class="gps-badge-blend-right">
                            <svg class="svgcorner svgcorner--2" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38"> <g id="Capa_1-2" data-name="Capa 1"> <path class="cls-1" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path> </g> </svg>
                        </div>

                       
                        <div class="gps-badge-category">
                            <!-- Custom Icon for Projects -->
                            <svg class="gps-badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 10h12M4 14h12M4 18h12M4 6h12" stroke-width="2" stroke-linecap="round"/>
                                <path d="M20 6v12" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            PROJECT
                        </div>
                        @if($project->location)
                         <span class="gps-badge-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            {{ $project->location }}
                        </span>
                        @endif
                    </div>
                    <p class="gps-desc">
                       {{ $project->title }}
                    </p>
                </div>
            </div>
            @empty
            <!-- Fallback Cards if no projects -->
            <!-- Card 1: Infrastructures -->
            <div class="gps-card">
                <div class="gps-image-wrapper">
                    <img src="{{ asset('images/featuredProjects/1-1-1-1.png') }}" alt="Infrastructures" class="gps-image">
                    
                    <!-- Badge -->
                    <div class="gps-badge">
                        <!-- Corner Blend SVG -->
                        <div class="gps-badge-blend-left">
                            <svg class="svgcorner" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38"> <g id="Capa_1-2" data-name="Capa 1"> <path class="cls-1" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path> </g> </svg>
                        </div>
                        <div class="gps-badge-blend-right">
                            <svg class="svgcorner svgcorner--2" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38"> <g id="Capa_1-2" data-name="Capa 1"> <path class="cls-1" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path> </g> </svg>
                        </div>

                       
                        <div class="gps-badge-category">
                            <!-- Custom Icon for Infrastructures (Bridge/Structure) -->
                            <svg class="gps-badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 10h12M4 14h12M4 18h12M4 6h12" stroke-width="2" stroke-linecap="round"/>
                                <path d="M20 6v12" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            INFRASTRUCTURES
                        </div>
                         <span class="gps-badge-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            Hotel, Dubai
                        </span>
                    </div>
                    <p class="gps-desc">
                       Crown Plaza Project
                    </p>
                </div>
            </div>

            <!-- Card 2: Logistics -->
            <div class="gps-card">
                <div class="gps-image-wrapper">
                    <img src="{{ asset('images/featuredProjects/2-1-1.png') }}" alt="Logistics" class="gps-image">
                    
                    <div class="gps-badge">
                          <div class="gps-badge-blend-left">
                            <svg class="svgcorner" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38"> <g id="Capa_1-2" data-name="Capa 1"> <path class="cls-1" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path> </g> </svg>
                        </div>
                        
                        <div class="gps-badge-blend-right">
                            <svg class="svgcorner svgcorner--2" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38"> <g id="Capa_1-2" data-name="Capa 1"> <path class="cls-1" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path> </g> </svg>
                        </div>

                       
                        <div class="gps-badge-category">
                            <!-- Custom Icon for Logistics (Warehouse/House) -->
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-6 9 6"></path>
                            <path d="M4 10v10h16V10"></path>
                            <path d="M9 20v-6h6v6"></path>
                            </svg>

                            LOGISTICS
                        </div>
                        <span class="gps-badge-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            Al Meydan Rd, Dubai
                        </span>
                    </div>
                    <p class="gps-desc">
                        Meydan Residence Project
                    </p>
                </div>
            </div>

            <!-- Card 3: Industry -->
            <div class="gps-card">
                <div class="gps-image-wrapper">
                    <img src="{{ asset('images/featuredProjects/4-1-1.png') }}" alt="Industry" class="gps-image">
                    
                    <div class="gps-badge">
                          <div class="gps-badge-blend-left">
                            <svg class="svgcorner" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38"> <g id="Capa_1-2" data-name="Capa 1"> <path class="cls-1" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path> </g> </svg>
                        </div>
                        
                       
                        <div class="gps-badge-category">
                            <!-- Custom Icon for Industry (Factory) -->
                            <svg class="gps-badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M17 18h1" stroke-width="2" stroke-linecap="round"/>
                                <path d="M12 18h1" stroke-width="2" stroke-linecap="round"/>
                                <path d="M7 18h1" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            INDUSTRY
                        </div>
                         <span class="gps-badge-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                              <div class="gps-badge-blend-right">
                            <svg class="svgcorner svgcorner--2" id="Capa_2" data-name="Capa 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.91 18.38"> <g id="Capa_1-2" data-name="Capa 1"> <path class="cls-1" d="m18.91,18.38V0H0c10.27,0,18.61,8.18,18.91,18.38Z"></path> </g> </svg>
                        </div>

                           Mall, Dubai
                        </span>
                    </div>
                    <p class="gps-desc">
                       Al Futtiam Shopping Mall
                    </p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- See All Button -->
        <div class="gps-btn-container">
            <a href="{{ route('featured-projects') }}" class="gps-btn">
                See all Project
                <span class="gps-btn-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>
