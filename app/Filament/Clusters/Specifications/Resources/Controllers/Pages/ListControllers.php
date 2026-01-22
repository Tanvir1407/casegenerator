<?php

namespace App\Filament\Clusters\Specifications\Resources\Controllers\Pages;

use App\Filament\Clusters\Specifications\Resources\Controllers\ControllerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class ListControllers extends ListRecords
{
    use HasSpecificationsTabs;

    protected static string $resource = ControllerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
