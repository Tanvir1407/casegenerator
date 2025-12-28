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
                                </div>
                            @endif
                            
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span class="blog-date">{{ $post->created_at->format('d M, Y') }}</span>
                                    <span class="blog-category">{{ strtoupper($post->category ?? 'MARKETING') }}</span>
                                </div>

                                <h3 class="blog-title">{{ $post->title }}</h3>
                                <p class="blog-excerpt">{{ Str::limit($post->content, 150, '...') }}</p>
                                <a href="{{ route('post.show', $post->slug) }}" class="blog-read-more">Read More →</a>
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
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date">21 Dec, 2025</span>
                                <span class="blog-category">MARKETING</span>
                            </div>
                            <h3 class="blog-title">Voluptatem dolor voluptate illo dolor et fugit nostrud aut</h3>
                            <p class="blog-excerpt">Porro dicta modi ull.sadalfkasdflkjsdsfkasjdfklasdf kasdfjaklsdfaksdafdsdfklasdjfklasjdfklasdjfk asdjfklasdjf klsadjfa...</p>
                            <a href="#" class="blog-read-more">Read More →</a>
                        </div>
                    </div>
                </article>
                
                <article class="blog-card">
                    <div class="blog-card-inner">
                        <div class="blog-image-wrapper">
                            <img src="{{ asset('images/landing/case-study-2.jpg') }}" 
                                 alt="Logistics case study" 
                                 class="blog-image"
                                 loading="lazy">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date">17 Dec, 2025</span>
                                <span class="blog-category">MARKETING</span>
                            </div>
                            <h3 class="blog-title">Error voluptas qui omnis totam ad et impedit quae nemo aut qui quod cillum quibusdam</h3>
                            <p class="blog-excerpt">Ut labore omnis even.guygiyutguyyu</p>
                            <a href="#" class="blog-read-more">Read More →</a>
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
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date">21 Dec, 2025</span>
                                <span class="blog-category">MARKETING</span>
                            </div>
                            <h3 class="blog-title">Perspiciatis omnis velit et eiusmod voluptatem magnam mollitia dolores aut obcaecati quis exercitation sit</h3>
                            <p class="blog-excerpt">Laudantium, consequa.dssafkasdfksdtkasdfjkasdfjasdkfjasdfjkasdfjkasdfkasdfj</p>
                            <a href="#" class="blog-read-more">Read More →</a>
                        </div>
                    </div>
                </article>
            @endif
        </div>

        <!-- View All Button -->
       <div class="gps-btn-container">
            <a href="{{ route('blog') }}" class="gps-btn">
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
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}



/* Blog Image */
.blog-image-wrapper {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: #f0f0f0;
}

.blog-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Blog Content */
.blog-content {
    padding: 30px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* Blog Meta */
.blog-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 13px;
}

.blog-date {
    color: #666;
    font-weight: 500;
}

/* Blog Category */
.blog-category {
    display: inline-block;
    background: #e8f0f7;
    color: #0066cc;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.3px;
    white-space: nowrap;
}

/* Blog Title */
.blog-title {
    font-size: 18px;
    font-weight: 600;
    color: #1a202c;
    line-height: 1.5;
    margin: 12px 0 16px 0;
}

/* Blog Excerpt */
.blog-excerpt {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin: 0 0 auto 0;
    flex-grow: 1;
}

/* Read More Link */
.blog-read-more {
    display: inline-block;
    color: #e91e63;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    margin-top: 16px;
    transition: all 0.3s ease;
}

.blog-read-more:hover {
    gap: 4px;
    letter-spacing: 0.5px;
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
    background: var(--primary-color);
    color: white;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-view-all:hover {
    background: var(--primary-hover);
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