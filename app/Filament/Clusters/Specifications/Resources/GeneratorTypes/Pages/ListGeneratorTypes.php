<?php

namespace App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages;

use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\GeneratorTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGeneratorTypes extends ListRecords
{
    protected static string $resource = GeneratorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
