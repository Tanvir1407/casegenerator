<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $sitemap .= $this->addUrl(route('home'), now(), 'daily', '1.0');

        // Static pages
        $staticPages = [
            ['url' => route('about'), 'priority' => '0.9'],
            ['url' => route('products.index'), 'priority' => '0.9'],
            ['url' => route('services'), 'priority' => '0.9'],
            ['url' => route('projects.index'), 'priority' => '0.9'],
            ['url' => route('featured-projects'), 'priority' => '0.8'],
            ['url' => route('blog'), 'priority' => '0.8'],
            ['url' => route('awards'), 'priority' => '0.7'],
            ['url' => route('faq'), 'priority' => '0.7'],
            ['url' => route('contact'), 'priority' => '0.8'],
        ];

        foreach ($staticPages as $page) {
            $sitemap .= $this->addUrl($page['url'], now(), 'weekly', $page['priority']);
        }

        // Products
        $products = Product::where('status', 'published')->get();
        foreach ($products as $product) {
            $sitemap .= $this->addUrl(
                route('products.show', $product->slug),
                $product->updated_at,
                'weekly',
                '0.8'
            );
        }

        // Projects
        $projects = Project::where('status', 'published')->get();
        foreach ($projects as $project) {
            $sitemap .= $this->addUrl(
                route('projects.show', $project->slug),
                $project->updated_at,
                'monthly',
                '0.7'
            );
        }

        // Blog posts
        $posts = Post::all();
        foreach ($posts as $post) {
            $sitemap .= $this->addUrl(
                route('post.show', $post->slug),
                $post->updated_at,
                'monthly',
                '0.6'
            );
        }

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Add URL to sitemap
     */
    private function addUrl($loc, $lastmod, $changefreq = 'monthly', $priority = '0.5')
    {
        $url = '<url>';
        $url .= '<loc>' . htmlspecialchars($loc) . '</loc>';
        $url .= '<lastmod>' . $lastmod->format('Y-m-d') . '</lastmod>';
        $url .= '<changefreq>' . $changefreq . '</changefreq>';
        $url .= '<priority>' . $priority . '</priority>';
        $url .= '</url>';

        return $url;
    }
}
