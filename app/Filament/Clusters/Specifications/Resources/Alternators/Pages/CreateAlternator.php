<?php

namespace App\Filament\Clusters\Specifications\Resources\Alternators\Pages;

use App\Filament\Clusters\Specifications\Resources\Alternators\AlternatorResource;
use Filament\Resources\Pages\CreateRecord;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class CreateAlternator extends CreateRecord
{
    use HasSpecificationsTabs;

    protected static string $resource = AlternatorResource::class;
}
