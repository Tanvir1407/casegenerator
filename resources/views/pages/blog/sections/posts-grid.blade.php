@php
    use Illuminate\Support\Facades\Storage;
@endphp
<section class="blog-listing-section">
    <style>
        /* Overall Section */
        .blog-listing-section {
            padding: 60px 20px;
            background-color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', sans-serif;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Grid */
        .blog-listing-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }

        @media (min-width: 768px) {
            .blog-listing-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .blog-listing-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Card */
        .blog-listing-card {
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .blog-listing-card:hover {
            /* transform: translateY(-8px); */
            /* box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08); */
        }

        /* Image */
        .blog-listing-image {
            position: relative;
            width: 100%;
            height: 250px; /* Fixed height for uniformity */
            overflow: hidden;
        }

        .blog-listing-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .blog-listing-card:hover .blog-listing-image img {
            /* transform: scale(1.05); */
        }

        /* Image Placeholder */
        .image-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }

        .placeholder-icon {
            width: 64px;
            height: 64px;
            color: #94a3b8;
        }

        /* Content */
        .blog-listing-content {
            padding: 28px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Meta */
        .blog-listing-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
            font-size: 0.875rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .blog-category-tag {
            background-color: #f1f5f9;
            color: #475569;
            padding: 4px 12px;
            border-radius: 999px;
            font-weight: 500;
        }

        /* Title */
        .blog-listing-title {
            margin: 0 0 16px;
            font-size: 1.5rem;
            line-height: 1.4;
            font-weight: 600;
            color: #1e293b;
        }

        .blog-listing-title a {
            text-decoration: none;
            color: inherit;
            transition: color 0.3s ease;
        }

        .blog-listing-title a:hover {
            color: var(--primary-color);
        }

        /* Excerpt */
        .blog-listing-excerpt {
            margin: 0 0 24px;
            font-size: 1rem;
            line-height: 1.7;
            color: #64748b;
            flex: 1;
        }

        /* Read More */
        .blog-read-more {
            align-self: flex-start;
            font-weight: 500;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.975rem;
        }

        .blog-read-more:hover {
            text-decoration: underline;
        }

        .blog-read-more::after {
            content: ' →';
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: #ffffff;
            padding: 13px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .pagination .page-item {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .pagination .page-link {
            min-width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            border-radius: 8px;
            text-decoration: none;
            color: #64748b;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
            border-color: #e2e8f0;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            color: #ffffff;
            border-color: var(--primary-color);
            cursor: default;
        }

        .pagination .page-item.active .page-link:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination .page-item.disabled .page-link {
            color: #cbd5e1;
            cursor: not-allowed;
            background-color: transparent;
            border-color: transparent;
        }

        .pagination .page-item.disabled .page-link:hover {
            background-color: transparent;
            border-color: transparent;
        }

        .pagination .page-link.ellipsis {
            cursor: default;
            pointer-events: none;
            color: #94a3b8;
            border: none;
        }

        /* Pagination Text */
        .pagination-info {
            margin-top: 16px;
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
            margin-left: 10px;
        }

        /* No Posts */
        .no-posts {
            text-align: center;
            padding: 80px 20px;
            color: #64748b;
        }

        .no-posts-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }
    </style>

    <div class="container">
        @if($posts && $posts->count() > 0)
            <div class="blog-listing-grid">
                @foreach($posts as $post)
                    <article class="blog-listing-card">
                        <div class="blog-listing-image">
                            <a href="{{ route('post.show', $post->slug) }}">
                                @if($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" 
                                         alt="{{ $post->image_alt_text ?? $post->title }}"
                                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 400 300%27%3E%3Crect fill=%27%23f3f4f6%27 width=%27400%27 height=%27300%27/%3E%3Cg fill=%27%239ca3af%27%3E%3Cpath d=%27M150 100h100v40H150z%27/%3E%3Cpath d=%27M160 160h80v10h-80z%27/%3E%3Cpath d=%27M160 180h60v8h-60z%27/%3E%3Ccircle cx=%27120%27 cy=%27120%27 r=%2715%27/%3E%3C/g%3E%3Ctext x=%27200%27 y=%27220%27 text-anchor=%27middle%27 font-family=%27Arial%27 font-size=%2714%27 fill=%27%239ca3af%27%3EImage not available%3C/text%3E%3C/svg%3E';">
                                @else
                                    <div class="image-placeholder">
                                        <svg class="placeholder-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="blog-listing-content">
                            <div class="blog-listing-meta">
                                <span class="blog-date">{{ $post->created_at->format('M d, Y') }}</span>
                                @if($post->category)
                                    <span class="blog-category-tag">{{ $post->category }}</span>
                                @endif
                            </div>
                            <h2 class="blog-listing-title">
                                <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            <p class="blog-listing-excerpt">{{ Str::limit(strip_tags($post->body), 150) }}</p>
                            <a href="{{ route('post.show', $post->slug) }}" class="blog-read-more">Read More</a>
                        </div>
                    </article>
                @endforeach
            </div>
            
            @if($posts->hasPages())
                <div class="pagination-wrapper">
                    {{ $posts->render('pagination::modern') }}
                </div>
            @endif
        @else
            <div class="no-posts">
                <div class="no-posts-icon">📝</div>
                <h3>No blog posts yet</h3>
                <p>Check back soon for interesting articles and case studies!</p>
            </div>
        @endif
    </div>
</section>