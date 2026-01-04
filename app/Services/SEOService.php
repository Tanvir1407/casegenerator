<?php

namespace App\Services;

use Artesaos\SEOTools\Facades\SEOTools;

/**
 * SEO Service Helper
 * Provides convenient methods for setting SEO across your application
 */
class SEOService
{
    /**
     * Default site configuration
     */
    private const SITE_NAME = 'Casa Generators';
    private const SITE_DESCRIPTION = 'Leading provider of high-quality generators and power solutions';
    private const TWITTER_HANDLE = '@casagenerators'; // Update with your actual handle

    /**
     * Set SEO for a product page
     */
    public function setProductSEO($product)
    {
        SEOTools::setTitle($product->title . ' - ' . self::SITE_NAME)
            ->setDescription($product->short_description ?: strip_tags(substr($product->description, 0, 160)))
            ->setCanonical(route('products.show', $product->slug))
            ->addImages([$product->featured_image_url]);

        return $this->getProductStructuredData($product);
    }

    /**
     * Set SEO for a project page
     */
    public function setProjectSEO($project)
    {
        SEOTools::setTitle($project->title . ' - ' . self::SITE_NAME . ' Projects')
            ->setDescription($project->description ?: 'View our completed project: ' . $project->title)
            ->setCanonical(route('projects.show', $project->slug))
            ->addImages([$project->featured_image_url]);

        return $this->getProjectStructuredData($project);
    }

    /**
     * Set SEO for a blog post
     */
    public function setPostSEO($post)
    {
        $description = strip_tags($post->body);
        $description = substr($description, 0, 160);

        SEOTools::setTitle($post->title . ' - ' . self::SITE_NAME . ' Blog')
            ->setDescription($description)
            ->setCanonical(route('post.show', $post->slug))
            ->addImages([$post->featured_image_url]);

        return $this->getArticleStructuredData($post);
    }

    /**
     * Set SEO for homepage
     */
    public function setHomepageSEO()
    {
        SEOTools::setTitle(self::SITE_NAME . ' - Quality Power Solutions')
            ->setDescription(self::SITE_DESCRIPTION)
            ->setCanonical(route('home'))
            ->addImages([asset('images/hero-banner.jpg')]);

        return $this->getOrganizationStructuredData();
    }

    /**
     * Set SEO for a generic page
     */
    public function setPageSEO($title, $description, $routeName = null, $image = null)
    {
        SEOTools::setTitle($title . ' - ' . self::SITE_NAME)
            ->setDescription($description);

        if ($routeName) {
            SEOTools::setCanonical(route($routeName));
        }

        if ($image) {
            SEOTools::addImages([$image]);
        }
    }

    /**
     * Get product structured data (JSON-LD)
     */
    private function getProductStructuredData($product)
    {
        return [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => $product->title,
            'image' => $product->featured_image_url,
            'description' => $product->short_description,
            'brand' => [
                '@type' => 'Brand',
                'name' => self::SITE_NAME
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => route('products.show', $product->slug),
                'priceCurrency' => 'USD',
                'price' => $product->price ?? null,
                'availability' => 'https://schema.org/InStock',
            ]
        ];
    }

    /**
     * Get project structured data (JSON-LD)
     */
    private function getProjectStructuredData($project)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $project->title,
            'description' => $project->description,
            'image' => $project->featured_image_url,
            'author' => [
                '@type' => 'Organization',
                'name' => self::SITE_NAME
            ],
            'locationCreated' => [
                '@type' => 'Place',
                'name' => $project->location
            ]
        ];
    }

    /**
     * Get article/blog post structured data (JSON-LD)
     */
    private function getArticleStructuredData($post)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post->title,
            'image' => $post->featured_image_url,
            'datePublished' => $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => self::SITE_NAME
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => self::SITE_NAME,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png')
                ]
            ]
        ];
    }

    /**
     * Get organization structured data (JSON-LD)
     */
    private function getOrganizationStructuredData()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => self::SITE_NAME,
            'url' => url('/'),
            'logo' => asset('images/logo.png'),
            'description' => self::SITE_DESCRIPTION,
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
                // Add your social media profiles
                // 'https://www.facebook.com/casagenerators',
                // 'https://www.linkedin.com/company/casagenerators',
                // 'https://twitter.com/casagenerators'
            ]
        ];
    }

    /**
     * Get breadcrumb structured data
     */
    public function getBreadcrumbStructuredData(array $breadcrumbs)
    {
        $itemListElement = [];
        
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $itemListElement[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $breadcrumb['name'],
                'item' => $breadcrumb['url'] ?? null
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElement
        ];
    }

    /**
     * Get FAQ structured data
     */
    public function getFAQStructuredData(array $faqs)
    {
        $mainEntity = [];
        
        foreach ($faqs as $faq) {
            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                ]
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity
        ];
    }
}
