@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ substr(strip_tags($post->body), 0, 160) }}">
    <title>{{ $post->title }} - CasaGenerators</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/Casagenerators Logo (1).png') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Override header for white background pages */
        .main-header {
            background: transparent !important;
        }

        .main-header:not(.scrolled) .logo-text {
            color: #1a1a1a !important;
        }

        .main-header:not(.scrolled) .nav-menu a {
            color: #1a1a1a !important;
        }

        .main-header:not(.scrolled) .btn-primary {
            color: #1a1a1a !important;
            border-color: #1a1a1a !important;
        }

        .main-header:not(.scrolled) .btn-primary:hover {
            background: #1a1a1a !important;
            color: white !important;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
            color: #1e293b;
            line-height: 1.6;
            font-size: 16px;
        }

        /* Main container */
        .post-wrapper {
            
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 2rem 1.5rem;
            margin-top: 90px;
        }

        .post-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        /* Back link */
        .back-link {
            display: inline-block;
            margin-bottom: 2rem;
            color: #2563eb;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.2s ease;
            position: relative;
            padding-left: 1.5rem;
        }

        .back-link::before {
            content: '←';
            position: absolute;
            left: 0;
            transition: transform 0.2s ease;
        }

        .back-link:hover {
            color: #1d4ed8;
        }

        .back-link:hover::before {
            transform: translateX(-0.25rem);
        }

        /* Post header */
        .post-header {
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .post-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            color: #0f172a;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .post-meta {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
            letter-spacing: 0.01em;
        }

        /* Featured image */
        .featured-image-wrapper {
            margin: 2.5rem 0;
            overflow: hidden;
        }

        .featured-image {
            width: 100%;
            height: 450px; /* Fixed banner height */
            object-fit: cover;
            display: block;
            background-color: #f1f5f9;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
            transition: box-shadow 0.3s ease;
        }

        .featured-image:hover {
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.12);
        }

        .image-caption {
            margin-top: 0.75rem;
            font-size: 0.875rem;
            color: #64748b;
            font-style: italic;
            text-align: center;
        }

        /* Post body typography */
        .post-body {
            font-size: 1.0625rem;
            line-height: 1.8;
            color: #334155;
            margin-bottom: 2rem;
        }

        .post-body h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
            margin: 2rem 0 1rem 0;
            line-height: 1.3;
        }

        .post-body h3 {
            font-size: 1.375rem;
            font-weight: 600;
            color: #0f172a;
            margin: 1.5rem 0 0.75rem 0;
            line-height: 1.4;
        }

        .post-body p {
            margin-bottom: 1.25rem;
        }

        .post-body ul,
        .post-body ol {
            margin-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .post-body li {
            margin-bottom: 0.5rem;
        }

        .post-body a {
            color: #2563eb;
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 0.25rem;
            transition: color 0.2s ease;
        }

        .post-body a:hover {
            color: #1d4ed8;
        }

        .post-body blockquote {
            border-left: 4px solid #cbd5e1;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
            color: #64748b;
            font-style: italic;
        }

        .post-body code {
            background-color: #f1f5f9;
            color: #e11d48;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Roboto Mono', Consolas, 'Courier New', monospace;
            font-size: 0.95em;
        }

        .post-body pre {
            background-color: #0f172a;
            color: #e2e8f0;
            padding: 1.25rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            margin: 1.5rem 0;
            font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Roboto Mono', Consolas, 'Courier New', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .post-body pre code {
            background-color: transparent;
            color: inherit;
            padding: 0;
            border-radius: 0;
        }

        /* Images within content */
        .post-body img {
            max-width: 100%;
            height: auto;
            margin: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .post-body img:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .post-body figure {
            margin: 2rem 0;
            text-align: center;
        }

        .post-body figcaption {
            font-size: 0.9rem;
            color: #64748b;
            margin-top: 0.5rem;
            font-style: italic;
        }

        /* Gallery section */
        .gallery-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
        }

        .gallery-title {
            font-size: 1.375rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 1.5rem;
            letter-spacing: -0.01em;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem;
            aspect-ratio: 1;
            background-color: #f1f5f9;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
            cursor: pointer;
            transition: box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.15);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        /* Modal */
        .image-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.85);
            z-index: 1000;
            padding: 1.5rem;
            animation: fadeIn 0.2s ease;
            backdrop-filter: blur(4px);
        }

        .image-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .modal-container {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            animation: slideUp 0.2s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(1rem);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-image {
            width: 100%;
            height: auto;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 0.5rem;
        }

        .modal-close {
            position: absolute;
            top: -2.5rem;
            right: 0;
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            font-weight: 300;
            cursor: pointer;
            padding: 0.5rem;
            transition: opacity 0.2s ease;
            line-height: 1;
        }

        .modal-close:hover {
            opacity: 0.7;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .post-wrapper {
                padding: 1.5rem 1rem;
            }

            .post-title {
                font-size: 1.875rem;
            }

            .post-body {
                font-size: 1rem;
                line-height: 1.75;
            }

            .post-body h2 {
                font-size: 1.5rem;
            }

            .post-body h3 {
                font-size: 1.25rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 0.75rem;
            }

            .modal-close {
                top: 0.5rem;
                right: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .post-wrapper {
                padding: 1.25rem 0.75rem;
            }

            .post-header {
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
            }

            .post-title {
                font-size: 1.5rem;
                margin-bottom: 0.75rem;
            }

            .post-body {
                font-size: 0.95rem;
                line-height: 1.7;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.5rem;
            }

            .featured-image-wrapper {
                margin: 1.5rem 0;
            }
        }

        /* Print styles */
        @media print {
            body {
                background-color: white;
            }

            .back-link,
            .image-modal {
                display: none;
            }

            .post-wrapper {
                padding: 0;
            }

            a {
                text-decoration: underline;
            }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #0f172a;
                color: #e2e8f0;
            }

            .post-body {
                color: #cbd5e1;
            }

            .post-title,
            .post-body h2,
            .post-body h3,
            .gallery-title {
                color: #f1f5f9;
            }

            .post-header {
                border-bottom-color: #334155;
            }

            .gallery-section {
                border-top-color: #334155;
            }

            .featured-image,
            .gallery-item {
                background-color: #1e293b;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }

            .gallery-item:hover {
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            }

            .post-body a {
                color: #60a5fa;
            }

            .post-body a:hover {
                color: #93c5fd;
            }

            .back-link {
                color: #60a5fa;
            }

            .back-link:hover {
                color: #93c5fd;
            }

            .post-body blockquote {
                border-left-color: #475569;
                color: #94a3b8;
            }

            .post-body code {
                background-color: #1e293b;
                color: #f87171;
            }

            .post-body pre {
                background-color: #1e293b;
                color: #e2e8f0;
            }

            .image-caption,
            .post-meta {
                color: #94a3b8;
            }
        }
    </style>
</head>
<body>
    @include('landing.sections.header')
    
    <div class="post-wrapper">
        <div class="post-container">
            
            
            <article>
                @if($post->featured_image)
                    <div class="featured-image-wrapper" style="margin-top: 0; margin-bottom: 2rem;">
                        <img src="{{ Storage::url($post->featured_image) }}" 
                             alt="{{ $post->image_alt_text ?? $post->title }}" 
                             class="featured-image">
                    </div>
                @endif
                <header class="post-header">
                    <h1 class="post-title">{{ $post->title }}</h1>
                    <p class="post-meta">Published on {{ $post->created_at->format('F d, Y') }}</p>
                </header>



                {{-- Post Body --}}
                <div class="post-body prose max-w-none prose-lg prose-slate dark:prose-invert">
                    {!! $post->body !!}
                </div>


            </article>
        </div>
    </div>

    {{-- Related Blog Posts Section --}}
    @if($randomPosts && $randomPosts->count() > 0)
        <section class="related-posts-section">
            <style>
                .related-posts-section {
                    padding: 60px 20px;
                    background-color: #ffffff;
                }

                .related-posts-container {
                    max-width: 1200px;
                    margin: 0 auto;
                }

                .related-posts-title {
                    font-size: 1.75rem;
                    font-weight: 700;
                    color: #1e293b;
                    margin-bottom: 3rem;
                    letter-spacing: -0.01em;
                }

                .related-posts-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 2rem;
                }

                @media (max-width: 1024px) {
                    .related-posts-grid {
                        grid-template-columns: repeat(2, 1fr);
                        gap: 1.5rem;
                    }
                }

                @media (max-width: 768px) {
                    .related-posts-grid {
                        grid-template-columns: 1fr;
                        gap: 1.5rem;
                    }

                    .related-posts-title {
                        font-size: 1.5rem;
                    }
                }

                .related-post-card {
                    border-radius: 12px;
                    overflow: hidden;
                    background: #ffffff;
                    border: 1px solid #e2e8f0;
                    transition: all 0.3s ease;
                    display: flex;
                    flex-direction: column;
                }

                /* .related-post-card:hover {
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
                    transform: translateY(-4px);
                } */

                .related-post-image {
                    position: relative;
                    width: 100%;
                    padding-top: 60%;
                    overflow: hidden;
                    background-color: #f1f5f9;
                    
                }

                .related-post-image a {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    display: block;
                }

                .related-post-image img {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.4s ease;
                }

                .related-post-card:hover .related-post-image img {
                    transform: scale(1.05);
                }

                .related-post-content {
                    padding: 1.5rem;
                    flex: 1;
                    display: flex;
                    flex-direction: column;
                }

                .related-post-meta {
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                    margin-bottom: 1rem;
                    font-size: 0.85rem;
                }

                .related-post-date {
                    color: #64748b;
                    font-weight: 500;
                }

                .related-post-category {
                    background-color: #f1f5f9;
                    color: #475569;
                    padding: 0.25rem 0.75rem;
                    border-radius: 999px;
                    font-weight: 500;
                    font-size: 0.8rem;
                }

                .related-post-title {
                    font-size: 1.125rem;
                    font-weight: 600;
                    color: #1e293b;
                    margin-bottom: 0.75rem;
                    line-height: 1.4;
                    flex: 1;
                }

                .related-post-title a {
                    text-decoration: none;
                    color: inherit;
                    transition: color 0.3s ease;
                }

                .related-post-title a:hover {
                    color: var(--primary-color);
                }

                .related-post-excerpt {
                    font-size: 0.95rem;
                    color: #64748b;
                    line-height: 1.6;
                    margin-bottom: 1rem;
                    flex: 1;
                }

                .read-more-link {
                    display: inline-block;
                    color: var(--primary-color);
                    font-weight: 600;
                    font-size: 0.95rem;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    margin-top: 0.5rem;
                }

                .read-more-link:hover {
                    color: var(--primary-hover);
                    transform: translateX(4px);
                }

                .related-post-author {
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                    padding-top: 1rem;
                    border-top: 1px solid #e2e8f0;
                }

                .related-post-avatar {
                    width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-weight: 600;
                    font-size: 0.875rem;
                    flex-shrink: 0;
                }

                .related-post-author-info {
                    display: flex;
                    flex-direction: column;
                }

                .related-post-author-name {
                    font-size: 0.875rem;
                    font-weight: 600;
                    color: #1e293b;
                }

                .related-post-author-title {
                    font-size: 0.8rem;
                    color: #94a3b8;
                }

                @media (prefers-color-scheme: dark) {
                    .related-posts-section {
                        background-color: #0f172a;
                    }

                    .related-posts-title {
                        color: #f1f5f9;
                    }

                    .related-post-card {
                        background: #1e293b;
                        border-color: #334155;
                    }

                    .related-post-title {
                        color: #f1f5f9;
                    }

                    .related-post-excerpt {
                        color: #cbd5e1;
                    }

                    .related-post-date {
                        color: #94a3b8;
                    }

                    .related-post-category {
                        background-color: #334155;
                        color: #cbd5e1;
                    }

                    .related-post-author-name {
                        color: #f1f5f9;
                    }

                    .read-more-link {
                        color: #f472b6;
                    }

                    .read-more-link:hover {
                        color: #ec4899;
                    }
                }
            </style>
            <div class="related-posts-container">
                <h2 class="related-posts-title">Related blog</h2>
                <div class="related-posts-grid">
                    @foreach($randomPosts as $post)
                        <article class="related-post-card">
                            @if($post->featured_image)
                                <div class="related-post-image">
                                    <a href="{{ route('post.show', $post->slug) }}">
                                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->image_alt_text ?? $post->title }}"
                                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 400 300%27%3E%3Crect fill=%27%23f3f4f6%27 width=%27400%27 height=%27300%27/%3E%3Cg fill=%27%239ca3af%27%3E%3Cpath d=%27M150 100h100v40H150z%27/%3E%3Cpath d=%27M160 160h80v10h-80z%27/%3E%3Cpath d=%27M160 180h60v8h-60z%27/%3E%3Ccircle cx=%27120%27 cy=%27120%27 r=%2715%27/%3E%3C/g%3E%3Ctext x=%27200%27 y=%27220%27 text-anchor=%27middle%27 font-family=%27Arial%27 font-size=%2714%27 fill=%27%239ca3af%27%3EImage not available%3C/text%3E%3C/svg%3E';">
                                    </a>
                                </div>
                            @endif
                            <div class="related-post-content">
                                <div class="related-post-meta">
                                    <span class="related-post-date">{{ $post->created_at->format('d M, Y') }}</span>
                                    <span class="related-post-category">Marketing</span>
                                </div>
                                <h3 class="related-post-title">
                                    <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="related-post-excerpt">{{ Str::limit(strip_tags($post->body), 120) }}</p>
                                <a href="{{ route('post.show', $post->slug) }}" class="read-more-link">Read More →</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Image Modal --}}
    <div id="imageModal" class="image-modal" onclick="if(event.target === this) closeImageModal()">
        <div class="modal-container">
            <button class="modal-close" 
                    onclick="closeImageModal()"
                    aria-label="Close modal">&times;</button>
            <img id="modalImage" src="" alt="" class="modal-image">
        </div>
    </div>

    <script>
        function openImageModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const image = document.getElementById('modalImage');
            image.src = imageSrc;
            image.alt = 'Enlarged gallery image';
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Make content images clickable for modal viewing
        document.addEventListener('DOMContentLoaded', function() {
            const contentImages = document.querySelectorAll('.post-body img');
            contentImages.forEach(function(img) {
                img.addEventListener('click', function() {
                    openImageModal(this.src);
                });
                img.style.cursor = 'pointer';
            });
        });

        // Close modal when pressing ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Prevent modal from closing when clicking on the image
        document.getElementById('modalImage')?.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>

    @include('landing.sections.footer')
    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>