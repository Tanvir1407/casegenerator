<?php

namespace App\Filament\Clusters\Specifications\Traits;

use App\Filament\Clusters\Specifications\Resources\Alternators\AlternatorResource;
use App\Filament\Clusters\Specifications\Resources\Controllers\ControllerResource;
use App\Filament\Clusters\Specifications\Resources\Engines\EngineResource;
use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\GeneratorTypeResource;

use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Navigation\NavigationItem;

trait HasSpecificationsTabs
{
    public static function getSubNavigationPosition(): SubNavigationPosition    {
        return SubNavigationPosition::Top;
    }

public function getSubNavigation(): array    {
        return [
            NavigationItem::make('Alternators')
                ->icon(AlternatorResource::getNavigationIcon())
                ->isActiveWhen(fn () => $this instanceof \App\Filament\Clusters\Specifications\Resources\Alternators\Pages\ListAlternators
                    || $this instanceof \App\Filament\Clusters\Specifications\Resources\Alternators\Pages\CreateAlternator
                    || $this instanceof \App\Filament\Clusters\Specifications\Resources\Alternators\Pages\EditAlternator)
                ->url(AlternatorResource::getUrl('index')),
            
            NavigationItem::make('Controllers')
                ->icon(ControllerResource::getNavigationIcon())
                ->isActiveWhen(fn () => $this instanceof \App\Filament\Clusters\Specifications\Resources\Controllers\Pages\ListControllers
                    || $this instanceof \App\Filament\Clusters\Specifications\Resources\Controllers\Pages\CreateController
                    || $this instanceof \App\Filament\Clusters\Specifications\Resources\Controllers\Pages\EditController)
                ->url(ControllerResource::getUrl('index')),

            NavigationItem::make('Engines')
                ->icon(EngineResource::getNavigationIcon())
                ->isActiveWhen(fn () => $this instanceof \App\Filament\Clusters\Specifications\Resources\Engines\Pages\ListEngines
                    || $this instanceof \App\Filament\Clusters\Specifications\Resources\Engines\Pages\CreateEngine
                    || $this instanceof \App\Filament\Clusters\Specifications\Resources\Engines\Pages\EditEngine)
                ->url(EngineResource::getUrl('index')),

            NavigationItem::make('Generator Types')
                ->icon(GeneratorTypeResource::getNavigationIcon())
                ->isActiveWhen(fn () => $this instanceof \App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages\ListGeneratorTypes
                    || $this instanceof \App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages\CreateGeneratorType
                    || $this instanceof \App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages\EditGeneratorType)
                ->url(GeneratorTypeResource::getUrl('index')),
        ];
    }
}
