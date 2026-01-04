<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\SEOTools;

/**
 * Example controller showing SEO implementation
 * This demonstrates how to add SEO meta tags to your existing controllers
 */
class ExampleSEOController extends Controller
{
    /**
     * Display a listing of products with SEO
     */
    public function index()
    {
        // Set SEO for products listing page
        SEOTools::setTitle('Our Products - Casa Generators')
            ->setDescription('Browse our complete range of high-quality generators and power solutions')
            ->setCanonical(route('products.index'))
            ->addImages([asset('images/products-banner.jpg')]);

        // Alternative: Set individually
        // SEOMeta::setTitle('Our Products - Casa Generators')
        //     ->setDescription('Browse our complete range of high-quality generators and power solutions')
        //     ->addKeyword(['generators', 'products', 'power solutions', 'industrial generators'])
        //     ->setCanonical(route('products.index'));

        // OpenGraph::setTitle('Our Products - Casa Generators')
        //     ->setDescription('Browse our complete range of high-quality generators and power solutions')
        //     ->setUrl(route('products.index'))
        //     ->addImage(asset('images/products-banner.jpg'), ['height' => 630, 'width' => 1200]);

        // TwitterCard::setTitle('Our Products - Casa Generators')
        //     ->setDescription('Browse our complete range of high-quality generators and power solutions')
        //     ->setImage(asset('images/products-banner.jpg'))
        //     ->setType('summary_large_image');

        $products = Product::where('status', 'published')
            ->orderBy('sort_order')
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    /**
     * Display a specific product with SEO
     */
    public function show(Product $product)
    {
        // Set dynamic SEO based on product
        SEOTools::setTitle($product->title . ' - Casa Generators')
            ->setDescription($product->short_description ?: strip_tags(substr($product->description, 0, 160)))
            ->setCanonical(route('products.show', $product->slug))
            ->addImages([$product->featured_image_url]);

        // Add product-specific keywords
        SEOMeta::addKeyword([
            $product->title,
            $product->category,
            'generator',
            'power solution',
            'casa generators'
        ]);

        // OpenGraph for social sharing
        OpenGraph::setTitle($product->title)
            ->setDescription($product->short_description)
            ->setType('product')
            ->setUrl(route('products.show', $product->slug))
            ->addImage($product->featured_image_url, [
                'height' => 630,
                'width' => 1200,
                'alt' => $product->image_alt_text ?? $product->title
            ])
            ->addProperty('product:price:amount', $product->price)
            ->addProperty('product:price:currency', 'USD');

        // Twitter Card
        TwitterCard::setTitle($product->title)
            ->setType('summary_large_image')
            ->setSite('@casagenerators') // Update with your Twitter handle
            ->setDescription($product->short_description)
            ->setImage($product->featured_image_url);

        // Add JSON-LD structured data for products
        $structuredData = [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => $product->title,
            'image' => $product->featured_image_url,
            'description' => $product->short_description,
            'brand' => [
                '@type' => 'Brand',
                'name' => 'Casa Generators'
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => route('products.show', $product->slug),
                'priceCurrency' => 'USD',
                'price' => $product->price,
                'availability' => 'https://schema.org/InStock',
            ]
        ];

        return view('products.show', compact('product', 'structuredData'));
    }

    /**
     * Display a blog post with SEO
     */
    public function showBlogPost($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->firstOrFail();

        // Extract plain text from body for description
        $description = strip_tags($post->body);
        $description = substr($description, 0, 160);

        SEOTools::setTitle($post->title . ' - Casa Generators Blog')
            ->setDescription($description)
            ->setCanonical(route('post.show', $post->slug))
            ->addImages([$post->featured_image_url]);

        // Article-specific OpenGraph
        OpenGraph::setTitle($post->title)
            ->setDescription($description)
            ->setType('article')
            ->setUrl(route('post.show', $post->slug))
            ->addImage($post->featured_image_url)
            ->addProperty('article:published_time', $post->created_at->toIso8601String())
            ->addProperty('article:modified_time', $post->updated_at->toIso8601String())
            ->addProperty('article:author', 'Casa Generators');

        // JSON-LD for articles
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post->title,
            'image' => $post->featured_image_url,
            'datePublished' => $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => 'Casa Generators'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Casa Generators',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png')
                ]
            ]
        ];

        $randomPosts = \App\Models\Post::inRandomOrder()->limit(3)->get();

        return view('pages.blog.sections.post-single', compact('post', 'randomPosts', 'structuredData'));
    }

    /**
     * Display a project with SEO
     */
    public function showProject(\App\Models\Project $project)
    {
        SEOTools::setTitle($project->title . ' - Casa Generators Projects')
            ->setDescription($project->description ?: 'View our completed project: ' . $project->title)
            ->setCanonical(route('projects.show', $project->slug))
            ->addImages([$project->featured_image_url]);

        OpenGraph::setTitle($project->title)
            ->setDescription($project->description)
            ->setType('article')
            ->setUrl(route('projects.show', $project->slug))
            ->addImage($project->featured_image_url)
            ->addProperty('article:section', 'Projects');

        // JSON-LD for CreativeWork
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $project->title,
            'description' => $project->description,
            'image' => $project->featured_image_url,
            'author' => [
                '@type' => 'Organization',
                'name' => 'Casa Generators'
            ],
            'locationCreated' => [
                '@type' => 'Place',
                'name' => $project->location
            ]
        ];

        return view('projects.show', compact('project', 'structuredData'));
    }

    /**
     * Homepage SEO
     */
    public function homepage()
    {
        SEOTools::setTitle('Casa Generators - Quality Power Solutions')
            ->setDescription('Leading provider of high-quality generators and power solutions. Trusted by industries worldwide.')
            ->setCanonical(route('home'))
            ->addImages([asset('images/hero-banner.jpg')]);

        // Add multiple keywords for homepage
        SEOMeta::addKeyword([
            'generators',
            'power solutions',
            'industrial generators',
            'casa generators',
            'power equipment',
            'backup power',
            'emergency generators'
        ]);

        // JSON-LD for Organization
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Casa Generators',
            'url' => url('/'),
            'logo' => asset('images/logo.png'),
            'description' => 'Leading provider of high-quality generators and power solutions',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Your City',
                'addressRegion' => 'Your State',
                'addressCountry' => 'Your Country'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+1-XXX-XXX-XXXX',
                'contactType' => 'Customer Service'
            ],
            'sameAs' => [
                'https://www.facebook.com/casagenerators',
                'https://www.linkedin.com/company/casagenerators',
                'https://twitter.com/casagenerators'
            ]
        ];

        return view('welcome', compact('structuredData'));
    }
}
