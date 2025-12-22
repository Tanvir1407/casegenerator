<section class="blog-cases-section">
    <div class="container-fluid">
        <!-- Section Header -->
        <div class="blog-header">
            <div class="blog-header-content">
                <h2 class="blog-section-title">Latest Case Studies & Insights</h2>
                <p class="section-description-blog">
                    Explore real-world examples of how we're transforming energy solutions
                </p>
            </div>
        </div>

        <!-- Blog Grid -->
        <div class="blog-grid">
            @if($posts && $posts->count() > 0)
                @foreach($posts as $index => $post)
                    <article class="blog-card">
                        <div class="blog-card-inner">
                            @if($post->featured_image)
                                <div class="blog-image-wrapper">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="blog-image"
                                         loading="lazy">
                                    <span class="application-badge">APPLICATION</span>
                                </div>
                            @endif
                            
                            <div class="blog-content">
                                <span class="blog-category">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ strtoupper($post->category ?? 'CASE STUDIES') }}
                                </span>

                                <h3 class="blog-title">{{ $post->title }}</h3>
                                <a href="{{ route('post.show', $post->slug) }}" class="btn-see-case">
                                    Read Blog
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <!-- Placeholder Articles -->
                <article class="blog-card">
                    <div class="blog-card-inner">
                        <div class="blog-image-wrapper">
                            <img src="{{ asset('images/landing/case-study-1.jpg') }}" 
                                 alt="Infrastructures case study" 
                                 class="blog-image"
                                 loading="lazy">
                            <span class="application-badge">APPLICATION</span>
                        </div>
                        <div class="blog-content">
                            <span class="blog-category">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                INFRASTRUCTURES
                            </span>
                            <h3 class="blog-title">Dagartech's 650 kVA power guarantees the continuity of a pumping station in Barcelona</h3>
                            <a href="#" class="btn-see-case">
                                Read Blog
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                
                <article class="blog-card blog-card-with-button">
                    <div class="blog-card-inner">
                        <div class="blog-image-wrapper">
                            <img src="{{ asset('images/landing/case-study-2.jpg') }}" 
                                 alt="Logistics case study" 
                                 class="blog-image"
                                 loading="lazy">
                            <span class="application-badge">APPLICATION</span>
                        </div>
                        <div class="blog-content">
                            <span class="blog-category">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                LOGISTICS
                            </span>
                            <h3 class="blog-title">Dagartech generating sets ensure the power supply for Leroy Merlin's New Logistics Platform in Portugal</h3>
                            <a href="#" class="btn-see-case">
                                Read Blog
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                
                <article class="blog-card">
                    <div class="blog-card-inner">
                        <div class="blog-image-wrapper">
                            <img src="{{ asset('images/landing/case-study-3.jpg') }}" 
                                 alt="Industry case study" 
                                 class="blog-image"
                                 loading="lazy">
                            <span class="application-badge">APPLICATION</span>
                        </div>
                        <div class="blog-content">
                            <span class="blog-category">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                INDUSTRY
                            </span>
                            <h3 class="blog-title">Dagartech successfully completes the installation of a High Power generator set in the winery of Pago de Carraovejas</h3>
                            <a href="#" class="btn-see-case">
                                Read Blog
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endif
        </div>

        <!-- View All Button -->
       <div class="gps-btn-container">
            <a href="#" class="gps-btn">
                See all Blog Cases
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

<style>
/* Blog Cases Section Styles */
.blog-cases-section {
    padding: 100px 0;
    background: #f5f5f5;
    position: relative;
}

/* Section Header */
.blog-header {
    text-align: center;
    margin-bottom: 60px;
    animation: fadeInUp 0.8s ease-out;
}

.blog-section-title {
    font-size: 42px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 20px;
    line-height: 1.2;
    text-align: center;
}

.section-description {
    font-size: 16px;
    color: #64748b;
    max-width: 700px;
    margin: 0;
    max-width: 100%;
    line-height: 1.7;
}

/* Blog Grid */
.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 30px;
    margin-bottom: 50px;
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
}

@media (max-width: 768px) {
    .blog-grid {
        grid-template-columns: 1fr;
    }
}

/* Blog Card */
.blog-card {
    animation: fadeInUp 0.8s ease-out;
    animation-fill-mode: both;
}

.blog-card:nth-child(1) { animation-delay: 0.1s; }
.blog-card:nth-child(2) { animation-delay: 0.2s; }
.blog-card:nth-child(3) { animation-delay: 0.3s; }

.blog-card-inner {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-card:hover .blog-card-inner {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

/* Blog Image */
.blog-image-wrapper {
    position: relative;
    width: 100%;
    height: 240px;
    overflow: hidden;
    background: #f0f0f0;
}

.blog-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.blog-card:hover .blog-image {
    transform: scale(1.05);
}

/* Application Badge */
.application-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.95);
    color: #666;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.5px;
    backdrop-filter: blur(10px);
}

/* Blog Content */
.blog-content {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* Blog Category */
.blog-category {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #cc3366;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.3px;
    margin-bottom: 15px;
}

.blog-category svg {
    width: 16px;
    height: 16px;
    stroke: #cc3366;
}

/* Blog Title */
.blog-title {
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
    line-height: 1.5;
    margin: 0;
}

/* See Case Button */
.btn-see-case {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #cc3366;
    color: white;
    padding: 12px 28px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    margin-top: 20px;
    transition: all 0.3s ease;
    align-self: flex-start;
}

.btn-see-case:hover {
    background: #b02954;
    gap: 12px;
}

.btn-see-case svg {
    width: 18px;
    height: 18px;
    transition: transform 0.3s ease;
}

.btn-see-case:hover svg {
    transform: translateX(4px);
}

/* Footer */
.blog-footer {
    text-align: center;
    padding-top: 20px;
}

.btn-view-all {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 36px;
    background: #cc3366;
    color: white;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-view-all:hover {
    background: #b02954;
    gap: 14px;
}

.btn-view-all svg {
    width: 18px;
    height: 18px;
    transition: transform 0.3s ease;
}

.btn-view-all:hover svg {
    transform: translateX(4px);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 992px) {
    .blog-section-title {
        font-size: 36px;
    }
    
    .section-description {
        font-size: 15px;
    }
    
    .blog-grid {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }
}

@media (max-width: 768px) {
    .blog-cases-section {
        padding: 60px 0;
    }
    
    .blog-header {
        margin-bottom: 40px;
    }
    
    .blog-section-title {
        font-size: 30px;
    }
    
    .section-description {
        font-size: 14px;
        padding: 0 20px;
    }
    
    .blog-image-wrapper {
        height: 200px;
    }
    
    .blog-content {
        padding: 20px;
    }
    
    .blog-title {
        font-size: 16px;
    }
    
    .blog-grid {
        gap: 20px;
    }
}

@media (max-width: 480px) {
    .blog-section-title {
        font-size: 26px;
    }
    
    .blog-image-wrapper {
        height: 180px;
    }
    
    .blog-content {
        padding: 18px;
    }
    
    .btn-view-all {
        padding: 12px 28px;
        font-size: 14px;
    }
}
</style>