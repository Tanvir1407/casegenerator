<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
// নিচের তিনটি লাইন সংশোধন করা হয়েছে
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            fn (): string => Blade::render('
            <style>
                /* Infolist Label Color Override */
                .fi-in-entry-label {
                    color: #747b85ff !important; /* Tailwind Gray 600 */
                }
            </style>
        ')
        );
        
        Paginator::useBootstrapFive();
    }
}