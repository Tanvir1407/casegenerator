<?php

namespace App\Filament\Clusters\Specifications\Resources\Alternators\Pages;

use App\Filament\Clusters\Specifications\Resources\Alternators\AlternatorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class EditAlternator extends EditRecord
{
    use HasSpecificationsTabs;

    protected static string $resource = AlternatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
