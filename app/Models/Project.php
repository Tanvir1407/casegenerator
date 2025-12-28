<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'featured_image',
        'image_alt_text',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title') && empty($project->slug)) {
                $project->slug = Str::slug($project->title);
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
     * Get the featured image path for storage operations
     */
    protected function featuredImagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->featured_image ? storage_path('app/public/' . $this->featured_image) : null,
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
     * Scope for published projects
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for featured projects
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for published and featured projects
     */
    public function scopePublishedAndFeatured($query)
    {
        return $query->published()->featured();
    }

    /**
     * Delete associated image files when project is deleted
     */
    protected static function booted()
    {
        parent::booted();
        
        static::deleting(function ($project) {
            // Delete featured image if it exists
            if ($project->featured_image && Storage::disk('public')->exists($project->featured_image)) {
                Storage::disk('public')->delete($project->featured_image);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
