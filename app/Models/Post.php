<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'featured_image',
        'gallery_images',
        'image_alt_text',
        'content_images',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'content_images' => 'array',
    ];

    /**
     * Clean up image files when post is deleted
     */
    protected static function booted()
    {
        parent::booted();
        
        static::deleting(function ($post) {
            $disk = Storage::disk('public');
            
            // Delete featured image
            if ($post->featured_image && $disk->exists($post->featured_image)) {
                $disk->delete($post->featured_image);
            }
            
            // Delete gallery images
            if ($post->gallery_images && is_array($post->gallery_images)) {
                foreach ($post->gallery_images as $image) {
                    if ($disk->exists($image)) {
                        $disk->delete($image);
                    }
                }
            }
            
            // Delete content images
            if ($post->content_images && is_array($post->content_images)) {
                foreach ($post->content_images as $image) {
                    if ($disk->exists($image)) {
                        $disk->delete($image);
                    }
                }
            }
        });
    }

    /**
     * Get the featured image URL
     */
    protected function featuredImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => app(ImageService::class)->url($this->featured_image)
        );
    }

    /**
     * Check if featured image exists in storage
     */
    public function hasFeaturedImage(): bool
    {
        return app(ImageService::class)->exists($this->featured_image);
    }

    /**
     * Get the gallery images URLs
     */
    protected function galleryImageUrls(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->gallery_images 
                ? collect($this->gallery_images)->map(fn ($image) => Storage::url($image))->toArray()
                : [],
        );
    }

    /**
     * Get the content images URLs
     */
    protected function contentImageUrls(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->content_images 
                ? collect($this->content_images)->map(fn ($image) => Storage::url($image))->toArray()
                : [],
        );
    }

    /**
     * Get formatted body with proper image URLs
     */
    protected function formattedBody(): Attribute
    {
        return Attribute::make(
            get: function () {
                $body = $this->body;
                
                if (!$body) {
                    return $body;
                }
                
                // Fix malformed URLs that contain localhost or domain concatenation
                $body = preg_replace_callback(
                    '/src="([^"]*)"/',
                    function ($matches) {
                        $src = $matches[1];
                        
                        // Skip external URLs and data URLs
                        if (preg_match('/^(https?:|data:)/', $src)) {
                            return $matches[0];
                        }
                        
                        // Handle malformed URLs with embedded localhost/domain
                        if (preg_match('/.*?(posts\/content\/[^\/]+\.(jpg|jpeg|png|gif|webp|svg))/', $src, $fileMatches)) {
                            $cleanPath = $fileMatches[1];
                            return 'src="' . Storage::url($cleanPath) . '"';
                        }
                        
                        // Handle normal storage paths
                        if (strpos($src, '/storage/') === 0) {
                            return $matches[0]; // Already correct
                        }
                        
                        // Handle relative paths for posts content
                        if (preg_match('/^posts\/content\//', $src)) {
                            return 'src="' . Storage::url($src) . '"';
                        }
                        
                        return $matches[0];
                    },
                    $body
                );
                
                return $body;
            }
        );
    }

    /**
     * Extract content images from body when saving and fix URLs
     */
    protected function body(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if (!$value) {
                    return $value;
                }
                
                // Convert any full URLs to relative paths
                $cleanedValue = preg_replace_callback(
                    '/src="([^"]*)"/',
                    function ($matches) {
                        $src = $matches[1];
                        
                        // Convert localhost or domain URLs to relative paths
                        if (preg_match('/^https?:\/\/[^\/]+(\/storage\/posts\/content\/[^\/]+\.(jpg|jpeg|png|gif|webp|svg))/', $src, $pathMatches)) {
                            return 'src="' . $pathMatches[1] . '"';
                        }
                        
                        return $matches[0];
                    },
                    $value
                );
                
                // Extract image paths from the content
                preg_match_all('/data-id="([^"]*posts\/content\/[^"]*)"/', $cleanedValue ?? '', $matches);
                
                if (empty($matches[1])) {
                    // Fallback: try to extract from src attributes
                    preg_match_all('/src="[^"]*\/storage\/([^"]*posts\/content\/[^"]*)"/', $cleanedValue ?? '', $matches);
                }
                
                $imagePaths = $matches[1] ?? [];
                
                // Store the extracted image paths
                $this->content_images = array_unique($imagePaths);
                
                return $cleanedValue;
            }
        );
    }
}
