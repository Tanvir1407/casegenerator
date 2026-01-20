<?php

namespace App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages;

use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\GeneratorTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGeneratorType extends EditRecord
{
    protected static string $resource = GeneratorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
