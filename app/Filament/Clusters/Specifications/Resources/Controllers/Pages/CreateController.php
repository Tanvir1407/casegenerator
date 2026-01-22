<?php

namespace App\Filament\Clusters\Specifications\Resources\Controllers\Pages;

use App\Filament\Clusters\Specifications\Resources\Controllers\ControllerResource;
use Filament\Resources\Pages\CreateRecord;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class CreateController extends CreateRecord
{
    use HasSpecificationsTabs;

    protected static string $resource = ControllerResource::class;
}
