<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Store an uploaded image to the specified directory
     */
    public function store(UploadedFile $file, string $directory = 'images', string $disk = 'public'): string
    {
        // Generate unique filename
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        
        // Store the file
        $path = $file->storeAs($directory, $filename, $disk);
        
        return $path;
    }

    /**
     * Get the full URL for an image path
     */
    public function url(?string $path, string $disk = 'public'): ?string
    {
        if (!$path) {
            return null;
        }

        // Handle external URLs
        if (str_starts_with($path, 'http')) {
            return $path;
        }

        // Generate relative storage URL using asset() for consistency with other parts of the application
        return asset('storage/' . $path);
    }

    /**
     * Check if an image file exists
     */
    public function exists(?string $path, string $disk = 'public'): bool
    {
        if (!$path) {
            return false;
        }

        return Storage::disk($disk)->exists($path);
    }

    /**
     * Delete an image file
     */
    public function delete(?string $path, string $disk = 'public'): bool
    {
        if (!$path || !$this->exists($path, $disk)) {
            return false;
        }

        return Storage::disk($disk)->delete($path);
    }

    /**
     * Delete multiple image files
     */
    public function deleteMany(array $paths, string $disk = 'public'): void
    {
        foreach ($paths as $path) {
            $this->delete($path, $disk);
        }
    }

    /**
     * Get image dimensions
     */
    public function getDimensions(?string $path, string $disk = 'public'): ?array
    {
        if (!$path || !$this->exists($path, $disk)) {
            return null;
        }

        $fullPath = Storage::disk($disk)->path($path);
        
        if (!function_exists('getimagesize')) {
            return null;
        }

        $dimensions = getimagesize($fullPath);
        
        return $dimensions ? [
            'width' => $dimensions[0],
            'height' => $dimensions[1],
            'type' => $dimensions[2],
            'mime' => $dimensions['mime']
        ] : null;
    }

    /**
     * Get optimized image URL with WebP fallback
     */
    public function getOptimizedUrl(?string $path, string $disk = 'public'): ?string
    {
        if (!$path) {
            return null;
        }

        // Check if WebP version exists
        $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);
        
        if ($this->exists($webpPath, $disk)) {
            return $this->url($webpPath, $disk);
        }

        // Fallback to original
        return $this->url($path, $disk);
    }

    /**
     * Clean up orphaned images in a directory
     */
    public function cleanupOrphanedImages(string $directory, array $usedPaths, string $disk = 'public'): int
    {
        $allFiles = Storage::disk($disk)->files($directory);
        $deletedCount = 0;

        foreach ($allFiles as $file) {
            if (!in_array($file, $usedPaths)) {
                if (Storage::disk($disk)->delete($file)) {
                    $deletedCount++;
                }
            }
        }

        return $deletedCount;
    }

    /**
     * Validate image file
     */
    public function validateImage(UploadedFile $file, array $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'], int $maxSizeKb = 5120): bool
    {
        // Check mime type
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            return false;
        }

        // Check file size (convert KB to bytes)
        if ($file->getSize() > ($maxSizeKb * 1024)) {
            return false;
        }

        return true;
    }

    /**
     * Generate responsive image sources
     */
    public function getResponsiveSources(?string $path, string $disk = 'public'): array
    {
        if (!$path) {
            return [];
        }

        $baseUrl = $this->url($path, $disk);
        $pathInfo = pathinfo($path);
        $baseName = $pathInfo['dirname'] . '/' . $pathInfo['filename'];

        // Generate different sizes
        $sizes = [
            'thumbnail' => $baseName . '_thumb.' . $pathInfo['extension'],
            'medium' => $baseName . '_md.' . $pathInfo['extension'],
            'large' => $baseName . '_lg.' . $pathInfo['extension'],
        ];

        $sources = ['original' => $baseUrl];

        foreach ($sizes as $size => $sizePath) {
            if ($this->exists($sizePath, $disk)) {
                $sources[$size] = $this->url($sizePath, $disk);
            }
        }

        return $sources;
    }
}