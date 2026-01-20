<?php

namespace App\Filament\Clusters\Specifications\Resources\Controllers\Pages;

use App\Filament\Clusters\Specifications\Resources\Controllers\ControllerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListControllers extends ListRecords
{
    protected static string $resource = ControllerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
