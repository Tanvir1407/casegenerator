<?php

namespace App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages;

use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\GeneratorTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class EditGeneratorType extends EditRecord
{
    use HasSpecificationsTabs;

    protected static string $resource = GeneratorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
