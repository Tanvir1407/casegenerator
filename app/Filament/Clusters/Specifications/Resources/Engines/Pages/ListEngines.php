<?php

namespace App\Filament\Clusters\Specifications\Resources\Engines\Pages;

use App\Filament\Clusters\Specifications\Resources\Engines\EngineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class ListEngines extends ListRecords
{
    use HasSpecificationsTabs;

    protected static string $resource = EngineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
