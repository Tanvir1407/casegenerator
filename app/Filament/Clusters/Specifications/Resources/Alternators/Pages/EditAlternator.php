<?php

namespace App\Filament\Clusters\Specifications\Resources\Alternators\Pages;

use App\Filament\Clusters\Specifications\Resources\Alternators\AlternatorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAlternator extends EditRecord
{
    protected static string $resource = AlternatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
