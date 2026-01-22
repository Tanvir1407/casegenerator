<?php

namespace App\Filament\Clusters\Specifications\Resources\Alternators\Pages;

use App\Filament\Clusters\Specifications\Resources\Alternators\AlternatorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class ListAlternators extends ListRecords
{
    use HasSpecificationsTabs;

    protected static string $resource = AlternatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
