<?php

namespace App\Filament\Clusters\Specifications\Resources\Engines\Pages;

use App\Filament\Clusters\Specifications\Resources\Engines\EngineResource;
use Filament\Resources\Pages\CreateRecord;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class CreateEngine extends CreateRecord
{
    use HasSpecificationsTabs;

    protected static string $resource = EngineResource::class;
}
