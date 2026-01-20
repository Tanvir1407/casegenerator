<?php

namespace App\Filament\Clusters\Specifications\Resources\Engines\Pages;

use App\Filament\Clusters\Specifications\Resources\Engines\EngineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEngine extends EditRecord
{
    protected static string $resource = EngineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
