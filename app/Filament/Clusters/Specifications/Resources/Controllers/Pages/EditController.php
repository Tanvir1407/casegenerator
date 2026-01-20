<?php

namespace App\Filament\Clusters\Specifications\Resources\Controllers\Pages;

use App\Filament\Clusters\Specifications\Resources\Controllers\ControllerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditController extends EditRecord
{
    protected static string $resource = ControllerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
