<?php

namespace App\Filament\Clusters\Specifications\Resources\GeneratorTypes\Pages;

use App\Filament\Clusters\Specifications\Resources\GeneratorTypes\GeneratorTypeResource;
use Filament\Resources\Pages\CreateRecord;

use App\Filament\Clusters\Specifications\Traits\HasSpecificationsTabs;

class CreateGeneratorType extends CreateRecord
{
    use HasSpecificationsTabs;

    protected static string $resource = GeneratorTypeResource::class;
}
