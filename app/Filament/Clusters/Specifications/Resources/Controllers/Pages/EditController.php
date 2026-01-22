<?php

namespace App\Filament\Clusters\Specifications\Resources\Controllers\Pages;

use App\Filament\Clusters\Specifications\Resources\Controllers\ControllerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class EditController extends EditRecord
{
    use HasSpecificationsTabs;

    protected static string $resource = ControllerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
